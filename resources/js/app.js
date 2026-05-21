import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import Chart from 'chart.js/auto';

window.Chart = Chart;

document.addEventListener('DOMContentLoaded', () => {

    const ctx = document.getElementById('usersChart');

    if (!ctx) return;

    new window.Chart(ctx, {

        type: 'line',

        data: {

            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],

            datasets: [{
                label: 'Users',
                data: [12, 19, 8, 15, 22, 30, 28],
                borderColor: '#111827',
                backgroundColor: 'rgba(17,24,39,0.1)',
                tension: 0.4,
                fill: true
            }]
        },

        options: {

            responsive: true,

            plugins: {
                legend: {
                    display: false
                }
            }

        }

    });

});