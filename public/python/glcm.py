import traceback
from skimage.feature import graycomatrix,graycoprops
from skimage import io, img_as_ubyte
import numpy as np
import sys

def extract_features(image_path):
    image = io.imread(image_path, as_gray=True)
    image = img_as_ubyte(image)
    glcm = graycomatrix(image, distances=[1], angles=[0], levels=256, symmetric=True, normed=True)
    contrast = graycoprops(glcm, 'contrast')[0, 0]
    correlation = graycoprops(glcm, 'correlation')[0, 0]
    energy = graycoprops(glcm, 'energy')[0, 0]
    homogeneity = graycoprops(glcm, 'homogeneity')[0, 0]
    entropy = -np.sum(glcm * np.log2(glcm + np.finfo(float).eps))
    return contrast, correlation, energy, homogeneity, entropy

if __name__ == "__main__":
    try:
        image_path = sys.argv[1]
        features = extract_features(image_path)
        print(",".join(str(x) for x in features))
    except Exception as e:
        with open('error_log.txt', 'w') as f:
            f.write(str(e))
            f.write(traceback.format_exc())
