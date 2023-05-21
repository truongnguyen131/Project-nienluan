<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
<input type="text" name="file-name" id="name">
  <input type="file" name="file" id="files" multiple><br><br>
  <button onclick="UploadFiles()">Upload</button>

  <script>
    function UploadFiles() {
      const name = document.getElementById("name");
    const files = document.getElementById("files");
    const formData = new FormData();
    // Creates empty formData object
    formData.append("name", name.value);
    // Appends value of text input
    for(let i =0; i < files.files.length; i++) {
        formData.append("files", files.files[i]);
    }
    // Appends value(s) of file input
    // Post data to Node and Express server:
    fetch('http://127.0.0.1:5000/api', {
        method: 'POST',
        body: formData, // Payload is formData object
    })
    .then(res => res.json())
    .then(data => console.log(data));}
  </script>
  <script>

  </script>
</body>

</html>