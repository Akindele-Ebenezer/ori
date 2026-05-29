<script>
    function openImagePreview(src) {
        document.getElementById('imagePreview').src = src;
        document.getElementById('imagePreviewModal').style.display = 'flex';
    }

    function closeImagePreview() {
        document.getElementById('imagePreviewModal').style.display = 'none';
    }

    document.querySelectorAll('.Location1 .location-map img').forEach(img => {
        img.addEventListener('click', () => {
            openImagePreview(img.src);
        });
    });

    //   
    const PLACEHOLDER = 'http://vesseltracker.lttcoastalmarine.com:8000/images/Vessels/SEA.gif';
    const sections = {
        slipwayLeft: '.inner-2a',
        slipwayRight: '.inner-1a',
        waterfront: '.inner-1b',
        jetty: '.inner-2b' 
    };
    const occupiedCounts = {};
    for (const [name, selector] of Object.entries(sections)) {
        const images = document.querySelectorAll(`${selector} img`);
        occupiedCounts[name] = [...images].filter(img => !img.src.endsWith('/images/Vessels/SEA.gif')).length;
    } 

    var ctx = document.getElementById('myChart').getContext('2d');

    var data = {
        labels: [
            'Total Vessels On Site',
            'Slipway Left',
            'Slipway Right',
            'Waterfront',
            'Jetty',
        ],
        datasets: [{
            label: 'Vessel Distribution',
            data: [Object.values(occupiedCounts).reduce((a, b) => a + b, 0), occupiedCounts.slipwayLeft, occupiedCounts.slipwayRight, occupiedCounts.waterfront, occupiedCounts.jetty],
            backgroundColor: [
                '#0B3C5D', 
                '#1B9AAA', 
                '#4CAF50', 
                '#FFC107', 
                '#607D8B'  
            ],
            borderColor: '#ffffff',
            borderWidth: 2,
            hoverBorderWidth: 3
        }]
    };

    var config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutoutPercentage: 60,

            title: {
                display: true,
                text: 'Vessel Distribution by Yard Section',
                fontSize: 16,
                fontStyle: 'bold',
                fontColor: '#0B3C5D',
                padding: 20
            },

            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 14,
                    padding: 15,
                    fontSize: 12,
                    fontColor: '#333'
                }
            },

            tooltips: {
                backgroundColor: '#0B3C5D',
                titleFontSize: 13,
                bodyFontSize: 12,
                cornerRadius: 6,
                callbacks: {
                    label: function(tooltipItem, chartData) {
                        var label = chartData.labels[tooltipItem.index] || '';
                        var value = chartData.datasets[0].data[tooltipItem.index];
                        return label + ': ' + value + ' vessels';
                    }
                }
            },

            animation: {
                animateRotate: true,
                animateScale: true
            }
        }
    };

    new Chart(ctx, config);


</script>