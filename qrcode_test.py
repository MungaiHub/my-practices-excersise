import qrcode

qr = qrcode.QRCode(  # Correct class name is QRCode
    version=15,
    box_size=10,
    border=5
)

data = "https://www.youtube.com/watch?v=JOya9FLaql8&list=RDMMVuRmImRnYFc&index=9"

qr.add_data(data)
qr.make(fit=True)
img = qr.make_image(fill="black", back_color="white")
img.save("test.png")

