import qrcode
import time  # For generating a unique timestamp

#z
qr = qrcode.QRCode(
    version=15,
    box_size=10,
    border=5
)

# Get the URL input from the user
data = input("Enter the URL you want to encode into a QR code: ")

# Add the user-provided data (URL) to the QRCode object
qr.add_data(data)
qr.make(fit=True)

# Generate the QR code image
img = qr.make_image(fill="black", back_color="white")

# Generate a unique filename using the current timestamp
filename = f"user_qrcode_{int(time.time())}.png"

# Save the QR code image to a file with a unique name
img.save(filename)

print(f"QR code generated and saved as {filename}")
