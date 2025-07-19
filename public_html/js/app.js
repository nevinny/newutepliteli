const track = document.getElementById('brandTrack');
const step = track.firstElementChild.offsetWidth + 32; // image width + gap (2rem = 32px)
let currentOffset = 0;

function slideBrands(direction) {
    const maxOffset = (track.children.length - 4) * step;
    currentOffset += direction * step;
    if (currentOffset < 0) currentOffset = 0;
    if (currentOffset > maxOffset) currentOffset = maxOffset;
    track.style.transform = `translateX(-${currentOffset}px)`;
}
