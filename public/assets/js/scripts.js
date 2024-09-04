document.addEventListener('DOMContentLoaded', function() {
    var lazyVideos = [].slice.call(document.querySelectorAll('video.lazy'));
    if ('IntersectionObserver' in window) {
        let lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let video = entry.target;
                    video.src = video.dataset.src;
                    video.classList.remove('lazy');
                    lazyVideoObserver.unobserve(video);
                }
            });
        });
        lazyVideos.forEach(function(video) {
            lazyVideoObserver.observe(video);
        });
    } else {
        // Fallback for browsers that do not support IntersectionObserver
        lazyVideos.forEach(function(video) {
            video.src = video.dataset.src;
            video.classList.remove('lazy');
        });
    }
});