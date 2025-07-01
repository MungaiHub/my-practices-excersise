document.getElementById('generate-qr').addEventListener('click', function () {
    const memberId = document.getElementById('member-id').textContent.trim();
    const amount = document.getElementById('amount').textContent.trim();

    // Clear previous QR code if any
    const qrContainer = document.getElementById('qr-code');
    qrContainer.innerHTML = '';

    // Combine data into one string (you can format it as needed)
    const qrData = `Member ID: ${memberId}\nAmount Due: ${amount}`;

    // Generate QR code
    new QRCode(qrContainer, {
        text: qrData,
        width: 200,
        height: 200,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
});
