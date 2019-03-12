# Script de Backup Banco de dados MySQL #
############################################################
# Confifgurações no Crontab                                #
############################################################
# Executar backup do banco a meia noite e ao meio dia
# Este horário está considerando GMT-2
# 00 02,14 * * * root /fontes/git/ugas/msugas/backup_mysql.sh
# Comprimir os Backups todo dia as 2 horas da manhã
# 01 4 * * * root /fontes/git/ugas/banco_de_dados/comprimir-backups-mysql.sh
############################################################
LOG_FILE=/var/log/git-monitoramento.log
#Data
NOW=$(date +"%m-%d-%Y-%T")
echo "Iniciando Update $NOW ..."
#File 
DIRETORIO=/var/www/html/monitoramento

#Entrando no diretorio
echo "----------------$NOW----------------------" >> $LOG_FILE
cd $DIRETORIO

git pull >> $LOG_FILE

echo "Atualizado..." >> $LOG_FILE
