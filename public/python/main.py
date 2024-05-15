import cv2
import numpy as np
from skimage.feature import graycomatrix, graycoprops, hog, canny
from skimage.transform import hough_circle
import sys
from PIL import Image


def ekstrak_ciri(gambar):
    """
    Fungsi untuk mengekstrak ciri gambar (warna, tekstur, bentuk, dan pola).

    Args:
      gambar: Matriks NumPy yang mewakili gambar.

    Returns:
      Kamus yang berisi ciri warna, tekstur, bentuk, dan pola.
    """

    # Konversi gambar ke ruang warna BGR
    gambar_bgr = cv2.cvtColor(gambar, cv2.COLOR_RGB2BGR)

    # Ekstraksi ciri warna

    ciri_warna = np.mean(gambar_bgr, axis=(0, 1))

    gray_image = cv2.cvtColor(gambar, cv2.IMREAD_GRAYSCALE)
    # Ekstraksi ciri tekstur

    glcm = graycomatrix(gray_image[:, :, 0], distances=[1], angles=[0], levels=256)
    ciri_tekstur = graycoprops(glcm)

    # Ekstraksi ciri bentuk
    circles = hough_circle(gray_image[:, :, 0], np.arange(1, 100), 10)
    ciri_bentuk = circles

    # Ekstraksi ciri pola
    ciri_pola = {}
    ciri_pola["hog"] = hog(gray_image[:, :, 0])

    # Gabungkan ciri-ciri
    ciri = ciri_warna, ciri_tekstur, ciri_bentuk, ciri_pola

    return ciri


if __name__ == "__main__":
    if len(sys.argv) != 2:
        sys.exit(1)

    image_path = sys.argv[1]
    file_path = Image.open(image_path).filename
    image = cv2.imread(image_path)
    ciri = ekstrak_ciri(image)
    print(",".join(str(x) for x in ciri))
