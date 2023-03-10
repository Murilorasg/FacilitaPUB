<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ler Comanda</title>
</head>
<body>
    <div id="camera"></div>
    
    <script src="../js/quagga.min.js"></script>
    <script>
    Quagga.init({
    inputStream : {
      name : "Live",
      type : "LiveStream",
      target: document.querySelector('#camera')
    },
    decoder : {
      readers : ["code_128_reader"]
    }
  }, function(err) {
      if (err) {
          console.log(err);
          return
      }
      console.log("Initialization finished. Ready to start");
      Quagga.start();

      Quagga.onDetected(function(data){
        console.log(data);

        resultado = data.codeResult.code;

        let url = window.opener.location.href;

        window.opener.location.href=url+"&cod="+resultado;

        window.close();

      });
  });;
</script>  
</body>
</html>