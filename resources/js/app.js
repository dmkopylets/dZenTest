import './bootstrap';

if (!window.Alpine) {
    import('alpinejs').then(Alpine => {
        window.Alpine = Alpine.default;
        Alpine.start();
    });
}
