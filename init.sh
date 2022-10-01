sudo xampp start
sudo docker build -t carshow .
sudo docker run -it --rm --name carshow-running carshow
#firefox "localhost/SistemasWeb/index.php"