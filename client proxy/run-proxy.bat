ECHO OFF
SET /p input="x64 or x86?"
IF /i "%input%" == "x64" GOTO x64
IF /i "%input%" == "x86" GOTO x86
:x64
CLS
ECHO "Running x64 version of client proxy"
cloud_sql_proxy_x64.exe -instances=people-and-phones:australia-southeast1:pap-inst=tcp:3306
GOTO end
:x86
CLS
ECHO "Running x86 version of client proxy"
cloud_sql_proxy_x86.exe -instances=people-and-phones:australia-southeast1:pap-inst=tcp:3306
:end
PAUSE
EXIT