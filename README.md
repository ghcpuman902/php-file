# php-file
A simple file searching and uploading system powered by php and jQuery

## Files And Their Uses

### 1. index.php

Search saved and uploaded files under `./files/`.

It uses ajax to send string to `file_list.php`, and display the returned results.

### 2. file_list.php

Use the given string to find matching file names under `./files/`.

### 3. upload.php

Upload file to `./files/`.

It uses ajax to send formData to `uploader.php`, and display the return string when files are succesfully uploaded.

### 4. uploader.php

Add time to the original file name and save the file to `./files/`.
