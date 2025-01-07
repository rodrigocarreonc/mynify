<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Clicks - Minify</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.webp">
</head>
<body>
    <div class="container">
        <header>
            <h1>Minify</h1>
            <p>Verifica cuántos clicks ha recibido un enlace</p>
        </header>
        <main>
            <form id="viewClicksForm">
                <input type="text" id="hashInput" placeholder="Ingresa el hash del enlace..." required>
                <button type="submit">Ver Clicks</button>
            </form>
            <div id="result" class="hidden">
                <p>El hash "<span id="hashResult"></span>"  tiene <span id="clicksCount">0</span> clicks.</p>
                <p>Url original: "<span id="originalUrl"></span>"</p>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('viewClicksForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const hash = document.getElementById('hashInput').value;
            
            fetch(`http://127.0.0.1:8000/api/clicks/${hash}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('hashResult').textContent = hash;
                document.getElementById('originalUrl').textContent = data.url;
                document.getElementById('clicksCount').textContent = data.clicks;
                document.getElementById('result').classList.remove('hidden');
            })
            .catch(error => {
                alert('Error: ' + error.message);
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>