<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <title><?= $model['title'] ?? 'Login Management' ?></title>
      <script src="https://cdn.tailwindcss.com"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
      <script>
            tailwind.config = {
                  theme: {},
                  darkMode: 'class'
            }
      </script>
</head>

<body>
      <div class="flex flex-col">
            <div class="min-h-screen">