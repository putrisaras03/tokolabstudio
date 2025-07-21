import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',   // berisi @tailwind base; components; utilities;
        'resources/js/app.js',     // boleh kosong dulu, atau JS‑mu
      ],
      refresh: true,
    }),
  ],
});
