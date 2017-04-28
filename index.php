<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="global.css">
</head>
<body>
  <div id="uploads"></div>
<div class="dropzone" id="dropzone">Drop files here to upload</div>

<script>
(function(){
  var dropzone = document.getElementById('dropzone');

  var displayUploads = function(data){
      var uploads = document.getElementById('uploads'),
          anchor,
          x;
      for(x = 0; x < data.length; x++){
        anchor = document.createElement('a');
        anchor.href = data[x].file;
        anchor.innerText = data[x].name;

        uploads.appendChild(anchor);
      }
  }

  var upload = function(files){
    var formData = new FormData(),
        xhr = new XMLHttpRequest(),
        x;
    for (x = 0; x < files.length; x++) {
      formData.append('file[]',files[x]);

      xhr.onload = function(){
        var data = JSON.parse(this.responseText);
        displayUploads(data);
      }

      xhr.open('post','upload.php');
      xhr.send(formData);
    }

  }

  dropzone.ondrop = function(e){
    e.preventDefault();
    this.className = 'dropzone';
    upload(e.dataTransfer.files);

  }
  dropzone.ondragover = function(){
    this.className = 'dropzone dragover';
    return false;
  }
  dropzone.ondragleave = function(){
    this.className = 'dropzone';
    return false;
  }
}());

</script>
</body>
</html>
