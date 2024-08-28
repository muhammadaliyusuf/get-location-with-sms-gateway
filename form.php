<!DOCTYPE html>
<html>

<head>
    <title>PHP SMS</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
</head>

<body>

    <h1>PHP SMS</h1>
    <form method="post" action="send.php">
        <label for="number">Number</label>
        <input type="text" name="number" id="number" />

        <label for="message">Message</label>
        <textarea name="message" id="message"></textarea>
        <input type="button" id="checkloc" value="Find Location"></input><br>

        <fieldset>
            <legend>Provider</legend>
            <label>
                <input type="radio" name="provider" value="infobip" checked /> Infobip
            </label>
        </fieldset>
        <button>Send</button>
    </form>

    <script>
        const getLocationBtn = document.getElementById('checkloc');
        const locationDataTextarea = document.getElementById('message');

        getLocationBtn.addEventListener('click', async () => {
            try {
                // Menggunakan CORS proxy untuk mengatasi masalah CORS (jika perlu)
                const response = await fetch('https://api.ipgeolocation.io/ipgeo?apiKey=1be0e4886b1b4cd087adaf3cedbb6c45&ip=2001:448a:5020:74d6:ed40:7ae5:6a1:38f7');
                const data = await response.json();

                // Memastikan data ada sebelum diakses
                if (data.city && data.latitude && data.longitude) {
                    const formattedData = `Kota: ${data.city}\nLatitude: ${data.latitude}\nLongitude: ${data.longitude}`;
                    locationDataTextarea.value = formattedData;
                } else {
                    locationDataTextarea.value = 'Data lokasi tidak ditemukan';
                }
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                locationDataTextarea.value = 'Terjadi kesalahan saat mengambil data lokasi';
            }
        });
    </script>
</body>

</html>