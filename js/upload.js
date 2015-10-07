// JavaScript Document

//$(function() {
 
function () {        
    /* No podemos usar $.bind() desde que el puñetero jQuery no normaliza los eventos */
    $('#dropzone')
        .get(0)
        .addEventListener('drop', upload, false);

    function upload(event) {
    
		var data = event.dataTransfer;
	
		var boundary = '------multipartformboundary' + (new Date).getTime();
		var dashdash = '--';
		var crlf     = '\r\n';
	
		/* Vivan el RFC2388 */
		var builder = '';
	
		builder += dashdash;
		builder += boundary;
		builder += crlf;
		
		var xhr = new XMLHttpRequest();
		
		/* Para cada fichero que tiremos en el control */
		for (var i = 0; i < data.files.length; i++) {
			var file = data.files[i];
	
			/* Metemos las cabeceras */            
			builder += 'Content-Disposition: form-data; name="user_file[]"';
			if (file.fileName) {
			  builder += '; filename="' + file.fileName + '"';
			}
			builder += crlf;
	
			builder += 'Content-Type: application/octet-stream';
			builder += crlf;
			builder += crlf; 
	
			/* Metemos los datos */
			builder += file.getAsBinary();
			builder += crlf;
	
			/* Escribimos la peticion */
			builder += dashdash;
			builder += boundary;
			builder += crlf;
		}
		
		/* Fin de la peticion */
		builder += dashdash;
		builder += boundary;
		builder += dashdash;
		builder += crlf;
	
		/* Aqeui definimos el destino via post del fichero de ajax para el upload */
		xhr.open("POST", "upload.php", true);
		xhr.setRequestHeader('content-type', 'multipart/form-data; boundary=' 
			+ boundary);
		xhr.sendAsBinary(builder);        
		
		xhr.onload = function(event) { 
			/* If we got an error display it. */
			if (xhr.responseText) {
				alert(xhr.responseText);
			}
			$("#dropzone").load("list.php?random=" +  (new Date).getTime());
		};
		
		/* Hacemos que el navegador no abra el fichero cuando se tire encima el muy cochino */
		event.stopPropagation();
		
	}
}

//}