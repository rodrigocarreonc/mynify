<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minify - Acortador de Links</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="icon.webp">
</head>
<body>
    <div class="container">
        <header>
            <h1>Minify</h1>
            <p>Acorta tus enlaces fácilmente</p>
        </header>
        <main>
            <form id="shortenForm">
                <input type="url" id="originalUrl" placeholder="Pega tu enlace aquí..." required>
                <button type="submit">Acortar</button>
            </form>
            <div id="result" class="hidden">
                <p>Tu enlace corto es:</p>
                <a id="shortUrl" href="#" target="_blank"></a>
                <button id="copyButton">Copiar</button>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('shortenForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const url = document.getElementById('originalUrl').value;
            fetch('shorten.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ url: url })
            })
            .then(response => response.json())
            .then(data => {
                const shortUrl = `https://myni.rodrigocarreon.com/${data.hash}`;
                document.getElementById('shortUrl').href = shortUrl;
                document.getElementById('shortUrl').textContent = shortUrl;
                document.getElementById('result').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
        });

        document.getElementById('copyButton').addEventListener('click', function() {
            const shortUrl = document.getElementById('shortUrl').href;
            navigator.clipboard.writeText(shortUrl).then(() => {
                alert('Enlace copiado al portapapeles');
            }).catch(err => {
                console.error('Error al copiar el enlace: ', err);
            });
        });
    </script>
    <script>
        document.getElementById('shortenForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const url = document.getElementById('originalUrl').value;
            fetch('shorten.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ url: url })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('shortUrl').href = `https://myni.rodrigocarreon.com/${data.hash}`;
                document.getElementById('shortUrl').textContent = `https://myni.rodrigocarreon.com/${data.hash}`;
                document.getElementById('result').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>