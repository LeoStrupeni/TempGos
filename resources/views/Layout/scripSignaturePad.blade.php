<!-- Scripts SACADOS DE ORDEN DE SERVICIO -->
<script
	src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript">
// NOTE: primer canva
var canvas = document.querySelector("canvas");
var signaturePad = new SignaturePad(canvas);
// Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible parameters)
signaturePad.toDataURL(); // save image as PNG
signaturePad.toDataURL("image/jpeg"); // save image as JPEG
signaturePad.toDataURL("image/svg+xml"); // save image as SVG
// Draws signature image from data URL.
// NOTE: This method does not populate internal data structure that represents drawn signature. Thus, after using #fromDataURL, #toData won't work properly.
signaturePad.fromDataURL("data:image/png;base64,iVBORw0K...");
// Returns signature image as an array of point groups
const firma = signaturePad.toData();
// Draws signature image from an array of point groups
signaturePad.fromData(firma);
// Clears the canvas
signaturePad.clear();
// Returns true if canvas is empty, otherwise returns false
signaturePad.isEmpty();
// Unbinds all event handlers
signaturePad.off();
// Rebinds all event handlers
signaturePad.on();


document.getElementById('clear').addEventListener('click', function () {
  signaturePad.clear();
});  // Borrado de los 2 clear
document.getElementById('clear2').addEventListener('click', function () {
  signaturePad2.clear();
});


// NOTE: segundo canva
var canvas2 = document.getElementById("signature-pad2");
var signaturePad2 = new SignaturePad(canvas2);
// Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible parameters)
signaturePad2.toDataURL(); // save image as PNG
signaturePad2.toDataURL("image/jpeg"); // save image as JPEG
signaturePad2.toDataURL("image/svg+xml"); // save image as SVG
// Draws signature image from data URL.
// NOTE: This method does not populate internal data structure that represents drawn signature. Thus, after using #fromDataURL, #toData won't work properly.
signaturePad2.fromDataURL("data:image/png;base64,iVBORw0K...");
// Returns signature image as an array of point groups
const firma2 = signaturePad2.toData();
// Draws signature image from an array of point groups
signaturePad2.fromData(firma2);
// Clears the canvas
signaturePad2.clear();
// Returns true if canvas is empty, otherwise returns false
signaturePad2.isEmpty();
// Unbinds all event handlers
signaturePad2.off();
// Rebinds all event handlers
signaturePad2.on();
</script>
