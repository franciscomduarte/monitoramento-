#Scripa para Executar Agendamento PHP

DIRETORIO=/var/www/html/monitoramento/

sleep 1
echo "Acessando o Diretório ... $DIRETORIO "
cd $DIRETORIO
sleep 1
echo "Executando o arquivo ..."
php -f monitoramento.php 
echo "Fim da execucao do agendamento"
