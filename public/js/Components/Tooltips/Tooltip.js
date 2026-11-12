document.addEventListener('mouseover', (event) => {
    if (!(event.target instanceof Element)) return;

    const tooltip = event.target.closest('.tooltip-x');
    const previousTarget = event.relatedTarget;
    if (!tooltip || (previousTarget instanceof Node && tooltip.contains(previousTarget))) return;

    tooltip.firstElementChild?.classList.add('Show');
});

document.addEventListener('mouseout', (event) => {
    if (!(event.target instanceof Element)) return;

    const tooltip = event.target.closest('.tooltip-x');
    const nextTarget = event.relatedTarget;
    if (!tooltip || (nextTarget instanceof Node && tooltip.contains(nextTarget))) return;

    tooltip.firstElementChild?.classList.remove('Show');
});