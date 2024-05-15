import cv2
import numpy as np
import sys
from PIL import Image
from skimage.feature import local_binary_pattern

def get_average_rgb(image_path):
    """
    Gets the average RGB values of an image.

    Args:
        image_path (str): Path to the image file.

    Returns:
        list: A list of average RGB values (red, green, blue).
    """
    image = cv2.imread(image_path)
    average_rgb = np.mean(image, axis=(0, 1))
    return average_rgb.tolist()

def get_texture_lbp(image_path):
    """
    Gets the texture features of an image using Local Binary Pattern (LBP).

    Args:
        image_path (str): Path to the image file.

    Returns:
        list: A list of LBP texture features.
    """
    image = cv2.imread(image_path, cv2.IMREAD_GRAYSCALE)
    lbp = local_binary_pattern(image, 8, 1)
    histogram, _ = np.histogram(lbp.ravel(), bins=256)
    return histogram.tolist()

def get_shape_features(image_path):
    """
    Gets the shape features of an image using OpenCV.

    Args:
        image_path (str): Path to the image file.

    Returns:
        list: A list of shape features (type, area, perimeter, bounding box).
    """
    image = cv2.imread(image_path)
    gray_image = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    _, thresh = cv2.threshold(gray_image, 127, 255, cv2.THRESH_BINARY)
    contours, _ = cv2.findContours(thresh, cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)

    shape_features = []
    for contour in contours:
        x, y, w, h = cv2.boundingRect(contour)
        area = cv2.contourArea(contour)
        perimeter = cv2.arcLength(contour, True)
        approx = cv2.approxPolyDP(contour, 0.01 * cv2.arcLength(contour, True), True)
        num_vertices = len(approx)

        if num_vertices == 3:
            shape_type = 'triangle'
        elif num_vertices == 4:
            shape_type = 'rectangle'
        else:
            shape_type = 'unknown'

        shape_features.append({
            'type': shape_type,
            'area': area,
            'perimeter': perimeter,
            'bounding_box': [x, y, w, h],
        })

    return shape_features


def get_pattern_features(image_path, template_path):
    """
    Gets the pattern features of an image using template matching.

    Args:
        image_path (str): Path to the image file.
        template_path (str): Path to the template file.

    Returns:
        list: A list of pattern features (coordinates, confidence).
    """
    image = cv2.imread(image_path)
    template = cv2.imread(template_path, cv2.IMREAD_GRAYSCALE)

    result = cv2.matchTemplate(image, template, cv2.TM_CCOEFF_NORMED)
    _, _, _, matches = cv2.minMaxLoc(result)

    pattern_features = []
    for match in matches:
        x, y, w, h = match
        confidence = result[y, x]

        pattern_features.append({
            'x': x,
            'y': y,
            'confidence': confidence,
        })

    return pattern_features

# Example usage
if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python main.py <image_path>")
        sys.exit(1)

    image_path = sys.argv[1]
    file_path = Image.open(image_path).filename

    average_rgb = get_average_rgb(image_path)
    texture_lbp = get_texture_lbp(image_path)
    shape_features = get_shape_features(image_path)
    # pattern_features = get_pattern_features(image_path, file_path)

    print(",".join(str(x) for x in average_rgb))
    print('Tekstur LBP:', texture_lbp)
    print('Fitur Bentuk:', shape_features)
    # print('Fitur Pola:', pattern_features)
