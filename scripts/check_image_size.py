import os

# images path
SCRIPT_PATH = os.path.dirname(__file__)
IMAGES_PATH = os.path.join(SCRIPT_PATH, '../images/')

# filter threshold
threshold = 400 # KB

files_info = []

# traverse
for root, dirs, files in os.walk(IMAGES_PATH):
    for file in files:
        file_path = os.path.join(root, file)
        file_size = os.path.getsize(file_path)
        files_info.append((file, file_size))

# Sort by file size descending
files_info.sort(key=lambda x: x[1], reverse=True)

# print
for file, size in files_info:
    kb = size / 1024
    if kb < threshold:
        continue
    print('File: %s, Size: %.2f KB'%(file, kb))

print('[Threshold = %s KB]'%threshold)