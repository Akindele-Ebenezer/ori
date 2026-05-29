class VesselDataRefresher {
    constructor(refreshIntervalMs = 600000) {
        this.refreshInterval = refreshIntervalMs;
        this.intervalId = null;
        this.isRefreshing = false;
    }

    init() {
        this.startAutoRefresh();
        this.initializeCloseButton();
    }

    startAutoRefresh() {
        if (this.intervalId) clearInterval(this.intervalId);
        this.intervalId = setInterval(async () => {
            await this.refreshVesselData();
        }, this.refreshInterval);
    }

    async refreshVesselData() {
        if (this.isRefreshing) return;
        this.isRefreshing = true;
        this.showLoadingIndicator();

        try {
            const response = await fetch(window.location.href, {
                credentials: 'same-origin',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!response.ok) throw new Error(`HTTP ${response.status}`);

            const html = await response.text();
            const parser = new DOMParser();
            const newDocument = parser.parseFromString(html, 'text/html');

            // 1. Update any static sections (if they exist on your page)
            this.replaceSection(newDocument, '.vessel-content');
            this.replaceSection(newDocument, '.Tanks');
            this.syncVessels(newDocument);

            // 2. ★ Extract the fresh vessels array from the new HTML ★
            const freshVessels = this.extractVesselsArray(newDocument);
            if (freshVessels && freshVessels.length) {
                this.updateSpotlightData(freshVessels);
            } else {
                console.warn('No vessel array found – spotlight not updated');
            }

            this.hideLoadingIndicator();
            this.showUpdateNotification();
        } catch (error) {
            console.error('Refresh failed:', error);
            this.showErrorNotification();
        } finally {
            this.isRefreshing = false;
        }
    }

    /**
     * Extract the 'vessels' array from the <script> block.
     * Works with your exact backend output (const vessels = [...]).
     */
    extractVesselsArray(newDocument) {
        const scripts = newDocument.querySelectorAll('script');
        for (let script of scripts) {
            const content = script.textContent || script.innerText;
            if (content.includes('const vessels = [')) {
                try {
                    const startIdx = content.indexOf('const vessels = [');
                    if (startIdx === -1) continue;
                    const bracketStart = content.indexOf('[', startIdx);
                    let bracketCount = 0;
                    let endIdx = bracketStart;
                    for (let i = bracketStart; i < content.length; i++) {
                        if (content[i] === '[') bracketCount++;
                        if (content[i] === ']') bracketCount--;
                        if (bracketCount === 0) {
                            endIdx = i + 1;
                            break;
                        }
                    }
                    const arrayString = content.substring(bracketStart, endIdx);
                    // Safely evaluate the array (the page is trusted)
                    const vesselsArray = new Function('return ' + arrayString)();
                    if (Array.isArray(vesselsArray) && vesselsArray.length) {
                        return vesselsArray;
                    }
                } catch (e) {
                    console.warn('Failed to parse vessels array:', e);
                }
            }
        }
        return null;
    }

    /**
     * Safely update the existing 'vessels' array (which is const but mutable).
     * Then re-render the UI and reset the auto-advance timer.
     */
    updateSpotlightData(newVessels) {
        if (!newVessels || !newVessels.length) return;

        // Remember current vessel name to preserve index
        const currentName = vessels[icurrentIndex] ? vessels[icurrentIndex].name : null;

        // Mutate the existing array (do NOT reassign 'vessels = ...')
        vessels.length = 0;
        vessels.push(...newVessels);

        // Find the new index for the same vessel name
        let newIndex = 0;
        if (currentName) {
            const found = vessels.findIndex(v => v.name === currentName);
            if (found !== -1) newIndex = found;
        } else {
            newIndex = Math.min(icurrentIndex, vessels.length - 1);
        }

        // Update global index and refresh the whole VesselSpotlight UI
        icurrentIndex = newIndex;
        renderVessel(icurrentIndex);   // this also calls renderVesselList() internally

        // Reset the progress bar timer so it doesn't auto-advance immediately
        lastUpdate = Date.now();
    }

    // ----- Existing helpers (unchanged, but fully compatible) -----
    syncVessels(newDocument) {
        const newVessels = newDocument.querySelectorAll('.vessel_map');
        newVessels.forEach(newVessel => {
            const id = newVessel.dataset.id;
            const currentVessel = document.querySelector(`.vessel_map[data-id="${id}"]`);
            if (!currentVessel) return;
            currentVessel.style.left = newVessel.style.left;
            currentVessel.style.top = newVessel.style.top;
            currentVessel.style.transform = newVessel.style.transform;
            currentVessel.dataset.rotation = newVessel.dataset.rotation;
            const newIndicator = newVessel.querySelector('.status-indicator');
            const currentIndicator = currentVessel.querySelector('.status-indicator');
            if (newIndicator && currentIndicator) {
                currentIndicator.style.background = newIndicator.style.background;
            }
            if (currentVessel.classList.contains('dragging')) return;
        });
    }

    replaceSection(newDocument, selector) {
        const newSection = newDocument.querySelector(selector);
        const currentSection = document.querySelector(selector);
        if (!newSection || !currentSection) {
            // Silently ignore missing sections – no breaking error
            return;
        }
        currentSection.innerHTML = newSection.innerHTML;
    }

    initializeCloseButton() {
        document.removeEventListener('click', this.handleDocumentClick);
        this.handleDocumentClick = (event) => {
            const closeButton = event.target.closest('.close-button-tanks button');
            if (closeButton) {
                const Tanks = document.querySelector('.Tanks');
                if (Tanks) {
                    Tanks.style.display = 'none';
                    event.preventDefault();
                }
            }
        };
        document.addEventListener('click', this.handleDocumentClick);
    }

    showLoadingIndicator() {
        const statusBar = document.getElementById('realTimeStatusBar');
        if (statusBar) statusBar.style.opacity = '0.8';
    }

    hideLoadingIndicator() {
        const statusBar = document.getElementById('realTimeStatusBar');
        if (statusBar) statusBar.style.opacity = '1';
    }

    showUpdateNotification() { this.showNotification('✅ Data Updated', '#00b894'); }
    showErrorNotification() { this.showNotification('❌ Update Failed', '#ff6b6b'); }

    showNotification(message, backgroundColor) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed; top: 70px; right: 20px; background: ${backgroundColor};
            color: white; padding: 8px 15px; border-radius: 15px; font-size: 12px;
            z-index: 1000; box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            font-family: monospace; backdrop-filter: blur(4px);
        `;
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 2000);
    }
}

// Start the refresher when the page is ready
document.addEventListener('DOMContentLoaded', function() {
    new VesselDataRefresher().init();
});