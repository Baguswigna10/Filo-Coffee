<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Filo Coffee') | Filo Coffee</title>
    <meta name="description" content="@yield('meta_description', 'Filo Coffee — Kesederhanaan dalam rasa, kehangatan dalam setiap cangkir.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'dark':        '#1a1815',
                    'dark-deep':   '#141210',
                    'dark-card':   '#211e1a',
                    'cream':       '#F5F0EB',
                    'cream-dark':  '#E8DFD5',
                    'mocca':       '#C9A87C',
                    'mocca-dark':  '#A68B5B',
                    'mocca-light': '#DECCB0',
                    'coffee':      '#6B4226',
                    'coffee-light':'#8B6040',
                    'warm':        '#2a2520',
                    'warm-light':  '#352f28',
                },
                fontFamily: {
                    'display': ['"Source Serif Pro"', 'Georgia', 'serif'],
                    'body':    ['"Poppins"', 'system-ui', 'sans-serif'],
                },
                borderRadius: {
                    '2xl': '1rem',
                    '3xl': '1.25rem',
                    '4xl': '1.5rem',
                },
                transitionDuration: {
                    '400': '400ms',
                    '600': '600ms',
                },
            }
        }
    }
