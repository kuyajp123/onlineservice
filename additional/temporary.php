<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Scrollbar Example</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: auto; /* Ensure scrollbars appear */
        }

        .content {
            height: 100px;
            overflow-y: scroll; /* Make this div scrollable */
            padding: 20px;
            box-sizing: border-box;
        }

        /* Custom scrollbar styles for .custom-scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 12px; /* Adjust scrollbar width */
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1; /* Track background */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #888; /* Scrollbar thumb color */
            border-radius: 6px; /* Rounded scrollbar thumb */
            border: 3px solid #f1f1f1; /* Padding around the thumb */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #555; /* Thumb color on hover */
        }
    </style>
</head>
<body>
    <div class="content custom-scrollbar">
        <h1>Custom Scrollbar for This Div</h1>
        <p>This div has a custom scrollbar. Scroll to see the custom styles in action.</p>
        <p>Additional content to make the scrollbar visible...</p>
        <p>Additional content to make the scrollbar visible...</p>
        <p>Additional content to make the scrollbar visible...</p>
    </div>

    <div class="content">
        <h1>Default Scrollbar for This Div</h1>
        <p>This div uses the default scrollbar style.</p>
    </div>
</body>
</html>
