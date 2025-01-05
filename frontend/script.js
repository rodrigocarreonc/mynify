document.addEventListener("DOMContentLoaded", () => {
    const shortenForm = document.getElementById("shortenForm");
    const originalUrlInput = document.getElementById("originalUrl");
    const resultDiv = document.getElementById("result");
    const shortUrlLink = document.getElementById("shortUrl");
    const copyButton = document.getElementById("copyButton");

    // Manejar el formulario
    shortenForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const originalUrl = originalUrlInput.value;

        try {
            // Realizar solicitud al backend
            const response = await fetch("https://myni.rodrigocarreon.com/api/short", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ url: "hola" }),
            });

            if (!response.ok) {
                throw new Error("Error al acortar el enlace.");
            }

            const data = await response.json();

            // Mostrar resultado
            shortUrlLink.href = data.short_url;
            shortUrlLink.textContent = data.short_url;
            resultDiv.classList.remove("hidden");
        } catch (error) {
            alert("Hubo un error: " + error.message);
        }
    });

    // Copiar al portapapeles
    copyButton.addEventListener("click", () => {
        navigator.clipboard.writeText(shortUrlLink.href).then(() => {
            alert("¡Enlace copiado al portapapeles!");
        });
    });
});
