function archivo(evt) {
    var files = evt.target.files;
    for (var i = 0, f; f = files[i]; i++) {
        if (!f.type.match('image.*')) {
            continue;
        }
        var reader = new FileReader();
        reader.onload = (function (theFile) {
            return function (e) {
                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src=" ', e.target.result, '" width="100%" title"', escape(theFile.name), '"/>'].join('');
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById('file').addEventListener('change', archivo, false);