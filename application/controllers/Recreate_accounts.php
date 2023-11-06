<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recreate_accounts extends CI_Controller {

    function __construct(){

        parent::__construct();

        $this->load->model('General_model');
        $this->g_m = $this->General_model;

        $this->load->model('tank_auth/users');
        $this->load->library('tank_auth');
        $this->country_code = FXPP::getUserCountryCode() or null;




       $this->partner = array(
            '1438316718',
            '1438316852',
            '1438317572',
            '1438319870',
            '1438320032',
            '1438320145',
            '1438320292',
            '1438320785',
            '1438321035',
            '1438325117',
            '1438328010',
            '1438762289',
            '1439268661',
            '1439269071',
            '1439273770',
            '1439281808',
            '1439364673',
            '1439365061',
            '1439365311',
            '1439366027',
            '1439366416',
            '1439366752',
            '1439369700',
            '1439370238',
            '1439373110',
            '1439374277',
            '1439375044',
            '1439375565',
            '1439707498',
            '1439803858',
            '1439804096',
            '1439805437',
            '1439805808',
            '1439806016',
            '1440505813',
            '1440591978',
            '1440592124',
            '1440592158',
            '1440592202',
            '1440592239',
            '1441173005',
            '1442394990',
            '1442808612',
            '1442808764',
            '1442952650',
            '1442990604',
            '1443023401',
            '1443108851',
            '1443430960',
            '1443528114',
            '1443580846',
            '1443641790',
            '1443689743',
            '1443689877',
        );
        $this->affiliatecode = array(
            'ACYZT',
            'AEJQO',
            'AGRKE',
            'AGSAX',
            'AHRTS',
            'AILFT',
            'AIUPW',
            'AJKIB',
            'ALFPD',
            'AMCWT',
            'ANBEF',
            'ANPVF',
            'ANWXH',
            'ANYFK',
            'AQNGL',
            'AQTBL',
            'ARGOZ',
            'ARYJI',
            'AUCEW',
            'AVFME',
            'AWVTR',
            'BFARZ',
            'BFRJF',
            'BKDRF',
            'BLJME',
            'BMWUX',
            'BNVSX',
            'BOPBG',
            'BPHFW',
            'BPHJP',
            'BPRHO',
            'BSWQH',
            'BTMWY',
            'BUCRV',
            'BVFJT',
            'BVZYS',
            'BWGZU',
            'BWXLN',
            'BXTDW',
            'BYEEX',
            'BYOMW',
            'CAGZM',
            'CDTXL',
            'CEPQC',
            'CFZRO',
            'CGQBH',
            'CGVWE',
            'CHUJI',
            'CIHFB',
            'CJFYT',
            'CKVVP',
            'CLIOE',
            'CMWPS',
            'CRAQB',
            'CRXBF',
            'CSFVU',
            'CSLIZ',
            'CTIKK',
            'CTMUG',
            'CTRLL',
            'CULPG',
            'CUSVX',
            'CUYZQ',
            'CYASH',
            'CYKVJ',
            'CYUAH',
            'CZFMV',
            'CZVPQ',
            'DBKJK',
            'DCTXT',
            'DEOSL',
            'DGHTE',
            'DGLGL',
            'DGTSJ',
            'DKTKA',
            'DLCXY',
            'DMHKD',
            'DMHKK',
            'DNWVZ',
            'DORGQ',
            'DPQLG',
            'DQBWE',
            'DQMAU',
            'DRQHL',
            'DRYRZ',
            'DSUXA',
            'DTBQJ',
            'DWVLB',
            'DXUBZ',
            'DXXYP',
            'DZEGH',
            'EAZKP',
            'EBEFK',
            'ECOXN',
            'EERYT',
            'EFPPL',
            'EIBGR',
            'EIGAD',
            'EIMQB',
            'EJTQL',
            'EKYGF',
            'ELBPI',
            'ENIBO',
            'ENVXG',
            'EONYD',
            'EPKJI',
            'EPTLX',
            'EPWXC',
            'EQTRD',
            'ERXDH',
            'ERYUD',
            'ETLHR',
            'ETNFO',
            'EWZMB',
            'EXFAJ',
            'FANHC',
            'FBKRK',
            'FBQEK',
            'FEAWB',
            'FGDJN',
            'FGZAI',
            'FHKTY',
            'FKWTN',
            'FMKGS',
            'FOUZH',
            'FPBMW',
            'FPSSZ',
            'FRZGR',
            'FSRLK',
            'FVLMW',
            'FWJEQ',
            'GAJQK',
            'GAYRN',
            'GBUEA',
            'GCNPJ',
            'GDNKI',
            'GHPFC',
            'GIZWK',
            'GKWJI',
            'GMEAG',
            'GNLEJ',
            'GPWJI',
            'GQUFA',
            'GQULX',
            'GTCOS',
            'GVSPB',
            'GWDIX',
            'GWOJU',
            'GYAUV',
            'HBCOV',
            'HBIYM',
            'HCUKN',
            'HDAOT',
            'HDMGC',
            'HEGVE',
            'HETAD',
            'HETHU',
            'HFDVO',
            'HFSGJ',
            'HHLCV',
            'HJCLE',
            'HMIKM',
            'HNCYP',
            'HNGUL',
            'HOMTD',
            'HORJB',
            'HPARX',
            'HPKNM',
            'HSJXY',
            'HSVCG',
            'HUHPJ',
            'HUVST',
            'HVALN',
            'HWCRF',
            'HWOAS',
            'IAOEW',
            'IAWQC',
            'ICYAB',
            'IDLQT',
            'IEQQV',
            'IERSZ',
            'IEYGA',
            'IFDLS',
            'IFVHL',
            'IIMFN',
            'ILRID',
            'ILXTJ',
            'IMAOD',
            'IMVQD',
            'INYRO',
            'IOITO',
            'IOTGU',
            'IQIGG',
            'IRWOF',
            'ISCAK',
            'ISCOH',
            'ITEBU',
            'ITPXG',
            'IVNXF',
            'IWDOJ',
            'IZATE',
            'IZDYL',
            'JBHPI',
            'JDNXZ',
            'JFFKZ',
            'JFJGZ',
            'JHECA',
            'JHSBU',
            'JMCGQ',
            'JOZGL',
            'JQGZS',
            'JQYKA',
            'JSPLN',
            'JSYGX',
            'JTHVJ',
            'JVABI',
            'JVZOB',
            'JWLAL',
            'JYHPL',
            'JYQGX',
            'JZNQD',
            'KCIEL',
            'KHFWO',
            'KIROG',
            'KKYJV',
            'KLAJC',
            'KNBLA',
            'KNFDL',
            'KNPJB',
            'KNQRE',
            'KPQVS',
            'KQKGO',
            'KRWNT',
            'KTIKB',
            'KTWUQ',
            'KTWZP',
            'KXTMD',
            'KZZXP',
            'LAJUF',
            'LANNI',
            'LEIZV',
            'LFPSB',
            'LHOUE',
            'LHUOE',
            'LIAXQ',
            'LIZDF',
            'LMWEO',
            'LPXFD',
            'LSAJE',
            'LTPYW',
            'LVVCT',
            'LYIAJ',
            'MAEBQ',
            'MASKY',
            'MBLOM',
            'MCRSY',
            'MDCRA',
            'MDGXQ',
            'MDNTV',
            'MEXIZ',
            'MFRHX',
            'MHKWX',
            'MITIH',
            'MLEUY',
            'MOWUW',
            'MRFPE',
            'MUNID',
            'MWFTR',
            'NAMRX',
            'NBIUM',
            'NBSWX',
            'NEHKV',
            'NFIPD',
            'NIYQS',
            'NJCAW',
            'NJGUZ',
            'NQFMP',
            'NQXYT',
            'NRENY',
            'NRHQX',
            'NTJNR',
            'NTLJM',
            'NVBPD',
            'NVQZC',
            'NWCTR',
            'NWKES',
            'NXCRE',
            'NYEVP',
            'NYXOH',
            'OAMHR',
            'OATIR',
            'OBHLW',
            'OCQGI',
            'ODJLG',
            'OFSKV',
            'OHXFI',
            'OKURJ',
            'OLMET',
            'OMTXW',
            'OQISG',
            'OQXTQ',
            'OSOHY',
            'OUSLR',
            'OXDPY',
            'OYXHX',
            'OZMNY',
            'PAQVH',
            'PDFKQ',
            'PETHK',
            'PEZRG',
            'PGHCU',
            'PHXKQ',
            'PIBVY',
            'PJCTS',
            'PKATW',
            'PLWVK',
            'PRDTG',
            'PRLBE',
            'PRYBC',
            'PSZQM',
            'PUFIT',
            'PWYRG',
            'PXCWZ',
            'PZOLV',
            'QAHEX',
            'QAJIG',
            'QBMUF',
            'QCSBA',
            'QGDKH',
            'QGLJH',
            'QGYJQ',
            'QHFZL',
            'QIVKU',
            'QJYXZ',
            'QLGIC',
            'QNDTQ',
            'QPPZF',
            'QRJLD',
            'QTGAU',
            'QVKKV',
            'QWTQI',
            'RBTGO',
            'RCMAH',
            'RDYAE',
            'RFJUQ',
            'RHJKX',
            'RKEOK',
            'RMLUL',
            'RNDAQ',
            'RPGNV',
            'RSXPN',
            'RTXCA',
            'RTXUV',
            'RUILZ',
            'RVIMD',
            'RVYFE',
            'RWYSJ',
            'RYAPA',
            'RZCLD',
            'RZPYO',
            'SABEC',
            'SBAWW',
            'SBQYI',
            'SDSKV',
            'SFOWL',
            'SFPLH',
            'SFZIZ',
            'SGCWO',
            'SGFNO',
            'SGRZC',
            'SGTJJ',
            'SHZBC',
            'SIAXK',
            'SJNQH',
            'SKVNH',
            'SLXFK',
            'SMCEL',
            'SOWHG',
            'SPXLY',
            'SRFRI',
            'SRIAG',
            'SSBMJ',
            'STMOI',
            'STTZN',
            'SUUYK',
            'SVGPS',
            'SVYKI',
            'SYJXK',
            'SYVKL',
            'SZKUV',
            'TAACU',
            'TAFON',
            'TAKAJ',
            'TAMWL',
            'TCFBS',
            'TDTPC',
            'TFUJO',
            'THADK',
            'TICXK',
            'TIGFS',
            'TIQNY',
            'TJVCU',
            'TJWEL',
            'TNSWF',
            'TPBBU',
            'TPKWQ',
            'TVLMB',
            'TWJHH',
            'TWULD',
            'TYAIC',
            'TYQQW',
            'TZAPV',
            'UAKIE',
            'UCMVF',
            'UEANN',
            'UEIRO',
            'UKOVT',
            'ULJBF',
            'UMCEQ',
            'UMDDH',
            'UMDKL',
            'UMPHX',
            'UNVIL',
            'UOJVV',
            'UONZS',
            'UPXOT',
            'UQACT',
            'UQXLR',
            'UVAGJ',
            'UWCXX',
            'UWOME',
            'UWPJJ',
            'UYOWT',
            'UYTOP',
            'UZEFS',
            'VACJQ',
            'VACMT',
            'VBIFA',
            'VDMEB',
            'VGBGZ',
            'VHEFK',
            'VHQAD',
            'VIMYA',
            'VIPKG',
            'VKORL',
            'VLCYI',
            'VMKRQ',
            'VMLXW',
            'VMRYC',
            'VMSIF',
            'VNWEB',
            'VQFYJ',
            'VRLSK',
            'VTXGC',
            'VUGXQ',
            'VUOTN',
            'VWNFL',
            'WBAOS',
            'WCGVT',
            'WCGYL',
            'WCSTG',
            'WEKJT',
            'WHHDV',
            'WIOTY',
            'WIQZP',
            'WITTK',
            'WLRIS',
            'WMYJE',
            'WQSHM',
            'WRLRG',
            'WTHVF',
            'WULKF',
            'WVISE',
            'XCRWZ',
            'XCYWR',
            'XEUHI',
            'XFIZK',
            'XIJAO',
            'XILRH',
            'XJMGZ',
            'XJRHM',
            'XLHRA',
            'XNZBG',
            'XOHQS',
            'XOUYZ',
            'XPKBF',
            'XQBIC',
            'XQHIX',
            'XQUYM',
            'XSDBR',
            'XTSLF',
            'XVCJD',
            'XWQKJ',
            'XZPHK',
            'YEALJ',
            'YHGYE',
            'YIFAJ',
            'YIQNM',
            'YJKCX',
            'YJOTN',
            'YKFIA',
            'YKTWB',
            'YNZUW',
            'YOKFB',
            'YRTFI',
            'YRXGF',
            'YSDDE',
            'YSSMF',
            'YSYDX',
            'YVMHF',
            'YVZGW',
            'YYARK',
            'YYUJE',
            'YZFQV',
            'YZUIS',
            'YZVIJ',
            'ZBESU',
            'ZCMBV',
            'ZFIVU',
            'ZGUIJ',
            'ZHJNY',
            'ZHSVY',
            'ZMAVE',
            'ZMDCI',
            'ZODSU',
            'ZOEHV',
            'ZTOJB',
            'ZWYUH',
            'ZXAAP',
        );
        $this->live = array(
//            '1031',
//            '1032',
//            '1033',
            '1034',
//            '1035',
//            '1036',
            '1037',
            '1038',
            '1040',
            '1041',
            '1042',
            '1043',
            '1044',
            '1045',
            '1046',
            '1047',
            '1048',
            '1049',
            '1050',
            '1051',
            '1052',
            '1053',
            '1054',
            '1055',
            '1056',
            '1057',
            '1059',
            '1060',
            '1061',
            '1062',
            '1063',
            '1064',
            '1065',
            '1066',
            '1067',
            '1068',
            '1069',
            '1071',
            '1072',
            '1073',
            '1074',
            '1075',
            '1076',
            '1077',
            '1078',
            '1079',
            '1080',
            '1081',
            '1082',
            '1084',
            '1085',
            '1088',
            '1089',
            '1090',
            '1091',
            '1092',
            '1093',
            '1094',
            '1095',
            '1096',
            '1097',
            '1098',
            '1099',
            '1100',
            '1101',
            '1102',
            '1103',
            '1104',
            '1105',
            '1106',
            '1107',
            '1108',
            '1109',
            '1110',
            '1111',
            '1112',
            '1113',
            '1114',
            '1115',
            '1116',
            '1117',
            '1118',
            '1119',
            '1120',
            '1121',
            '1122',
            '1123',
            '1124',
            '1125',
            '1126',
            '1127',
            '1128',
            '1129',
            '1130',
            '1131',
            '1132',
            '1133',
            '1134',
            '1135',
            '1136',
            '1137',
            '1138',
            '1139',
            '1140',
            '1141',
            '1142',
            '1143',
            '1144',
            '1145',
            '1146',
            '1147',
            '1148',
            '1149',
            '1150',
            '1151',
            '1152',
            '1153',
            '1154',
            '1155',
            '1156',
            '1157',
            '1158',
            '1159',
            '1160',
            '1161',
            '1162',
            '1163',
            '1164',
            '1165',
            '1166',
            '1167',
            '1168',
            '1169',
            '1170',
            '1171',
            '1172',
            '1173',
            '1174',
            '1175',
            '1176',
            '1177',
            '1178',
            '1179',
            '1180',
            '1181',
            '1182',
            '1183',
            '1184',
            '1185',
            '1186',
            '1187',
            '1188',
            '1189',
            '1190',
            '1191',
            '1192',
            '1193',
            '1194',
            '1195',
            '1196',
            '1197',
            '1198',
            '1199',
            '1200',
            '1201',
            '1202',
            '1203',
            '1204',
            '1205',
            '1207',
            '1208',
            '1209',
            '1210',
            '1211',
            '1212',
            '1213',
            '1214',
            '1215',
            '1216',
            '1217',
            '1218',
            '1219',
            '1220',
            '1221',
            '1222',
            '1223',
            '1224',
            '1225',
            '1226',
            '1227',
            '1228',
            '1229',
            '1230',
            '1231',
            '1232',
            '1233',
            '1234',
            '1235',
            '1236',
            '1237',
            '1238',
            '1239',
            '1240',
            '1241',
            '1242',
            '1243',
            '1244',
            '1245',
            '1246',
            '1247',
            '1248',
            '1249',
            '1250',
            '1251',
            '1252',
            '1253',
            '1254',
            '1255',
            '1256',
            '1257',
            '1258',
            '1259',
            '1260',
            '1261',
            '1262',
            '1263',
            '1264',
            '1265',
            '1266',
            '1267',
            '1268',
            '1269',
            '1270',
            '1271',
            '1272',
            '1273',
            '1274',
            '1275',
            '1276',
            '1277',
            '1278',
            '1279',
            '1280',
            '1281',
            '1282',
            '1283',
            '1284',
            '1285',
            '1286',
            '1287',
            '1288',
            '1289',
            '1290',
            '1291',
            '1292',
            '1293',
            '1294',
            '1295',
            '1296',
            '1297',
            '1298',
            '1300',
            '1301',
            '1302',
            '1303',
            '1304',
            '1305',
            '1306',
            '1307',
            '1308',
            '1309',
            '1310',
            '1311',
            '1312',
            '1313',
            '1314',
            '1315',
            '1318',
            '1320',
            '1322',
            '1323',
            '1025',
            '1324',
            '1325',
            '1326',
            '1327',
            '1335',
            '1336',
            '1338',
            '1339',
            '1340',
            '1341',
            '1342',
            '1343',
            '1344',
            '1345',
            '1346',
            '1347',
            '1348',
            '1027',
            '1349',
            '1350',
            '1351',
            '1353',
            '1354',
            '1355',
            '1356',
            '1357',
            '1358',
            '1359',
            '1360',
            '1361',
            '1362',
            '1363',
            '1364',
            '1365',
            '1366',
            '1367',
            '1368',
            '1369',
            '1370',
            '1371',
            '1372',
            '1373',
            '1374',
            '1375',
            '1376',
            '1377',
            '1378',
            '1379',
            '1380',
            '1381',
            '1382',
            '1383',
            '1384',
            '1385',
            '1028',
            '1387',
            '1388',
            '1389',
            '1390',
            '1391',
            '1392',
            '1393',
            '1394',
            '1395',
            '1396',
            '1397',
            '1398',
            '1399',
            '1400',
            '1029',
            '1401',
            '1402',
            '1403',
            '1404',
            '1405',
            '1406',
            '1407',
            '1408',
            '1409',
            '1410',
            '1411',
            '1412',
            '1413',
            '1414',
            '1415',
            '1416',
            '1417',
            '1418',
            '1419',
            '1420',
            '1421',
            '1422',
            '1423',
            '1424',
            '1425',
            '1426',
            '1427',
            '1428',
            '1429',
            '1430',
            '1431',
            '1432',
            '1433',
            '1434',
            '1435',
            '1436',
            '1437',
            '1438',
            '1439',
            '1034',
            '1440',
            '1441',
            '1442',
            '1443',
            '1444',
            '1445',
            '1446',
            '1447',
            '1448',
            '1449',
            '1451',
            '1452',
            '1453',
            '1454',
            '1455',
            '1456',
            '1457',
            '1458',
            '1035',
            '1459',
            '1460',
            '1461',
            '1462',
            '1463',
            '1464',
            '1465',
            '1036',
            '1466',
            '1468',
            '1469',
            '1470',
            '1471',
            '1472',
            '1473',
            '1474',
            '1475',
            '1476',
            '1477',
            '1478',
            '1479',
            '1480',
            '1481',
            '1482',
            '1483',
            '1484',
            '1485',
            '1486',
            '1487',
            '1488',
            '1489',
            '1490',
            '1037',
            '1491',
            '1492',
            '1493',
            '1494',
            '1495',
            '1496',
            '1497',
            '1498',
            '1499',
            '1500',
            '1501',
            '1502',
            '1503',
            '1504',
            '1505',
            '1506',
            '1507',
            '1508',
            '1509',
            '1510',
            '1511',
            '1512',
            '1038',
            '1513',
            '1514',
            '1515',
            '1516',
            '1517',
            '1518',
            '1519',
            '1520',
            '1521',
            '1522',
            '1523',
            '1524',
            '1525',
            '1526',
            '1527',
            '1528',
            '1529',
            '1530',
            '1531',
            '1532',
            '1533',
            '1534',
            '1535',
            '1536',
            '1537',
            '1538',
            '1539',
            '1540',
            '1541',
            '1039',
            '1542',
            '1543',
            '1544',
            '1545',
            '1546',
            '1547',
            '1548',
            '1549',
            '1550',
            '1551',
            '1552',
            '1553',
            '1554',
            '1040',
            '1555',
            '1556',
            '1557',
            '1558',
            '1559',
            '1560',
            '1561',
            '1041',
            '1562',
            '1563',
            '1564',
            '1565',
            '1566',
            '1567',
            '1568',
            '1042',
            '1569',
            '1043',
            '1570',
            '1571',
            '1572',
            '1573',
            '1044',
            '1045',
            '1574',
            '1575',
            '1576',
            '1577',
            '1578',
            '1046',
            '1579',
            '1580',
            '1581',
            '1582',
            '1583',
            '1584',
            '1585',
            '1586',
            '1587',
            '1588',
            '1589',
            '1590',
            '1591',
        );
//        $this->partner = array('168652');
//        $this->live = array('140093');
    }

    public function index(){
        if (IPLoc::Office_and_Vpn()){
        }
    }

    public function partner(){

        if (IPLoc::Office_and_Vpn()){
            die();
            $this->load->library('fx_mailer');
            $this->load->library('tank_auth');
            $this->load->model('user_model');
            $this->load->model('account_model');
            $this->lang->load('tank_auth');
            $this->g_m = $this->general_model;
            $this->js = $this->template->Js();
            $this->load->helper('string');
            $this->country_code = FXPP::getUserCountryCode() or null;
            $this->lang->load('partnership');
            $this->nlanguage = FXPP::html_url();

            foreach($this->partner as $key => $value ){

                $this->db->trans_start();

                $data['partnership'] = $this->general_model->showssingle($table='partnership',$id='reference_num', $field=$value,$select='*');
                $data['users'] = $this->general_model->showssingle($table='users',$id='id', $field= $data['partnership']['partner_id'],$select='*');
                $data['user_profiles'] = $this->general_model->showssingle($table='user_profiles',$id='user_id', $field= $data['partnership']['partner_id'],$select='*');
                if($data['user_profiles']){

                    $data['contacts'] = $this->general_model->showssingle($table='contacts',$id='user_id', $field= $data['partnership']['partner_id'],$select='*');

                    $generatePass = FXPP::generateGUIDForgotPassword(8);

                    $use_username = $this->config->item('use_username', 'tank_auth');

                    $email_activation = $this->config->item('email_activation', 'tank_auth');

                    $login_type = 1;
                    $phone_password =  FXPP::RandomizeCharacter(7);
                    $user_inser_data = $this->tank_auth->create_user(
                        $use_username,
                        $data['users']['email'] ,
                        $generatePass,
                        $email_activation,
                        1,
                        $login_type,
                        $phone_password
                    );

                    $partner_id = $user_inser_data['user_id'];
                    $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
                    $data['save_hash'] = array(
                        'first_login_hash' => $data['random_alpha_string_analytics'] ,
                        'first_login_stat' => 1
                    );

                    $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);

                    $profile = array(
                        'full_name' => $data['user_profiles']['full_name'],
                        'user_id' => $partner_id,
                        'country' => $data['user_profiles']['country'],
                        'skype' => $data['user_profiles']['skype']
                    );

                    $this->general_model->insert('user_profiles', $profile);

                    $websites =  $data['partnership']['websites'];

                    if(IPLoc::isChinaIP() || $data['user_profiles']['country'] == 'CN' || FXPP::html_url() == 'zh' ){
                        $this->session->set_userdata('isChina', '1');
                    }

                    $groupCurrency = $this->general_model->getGroupCurrency(3,$data['partnership']['currency']);

                    $service_data = array(
                        'address' => '',
                        'city' => '',
                        'country' => $this->general_model->getCountries($data['user_profiles']['country']),
                        'email' => $data['users']['email'],
                        'group' => $groupCurrency,
                        'leverage' => '',
                        'name' => $data['user_profiles']['full_name'],
                        'phone_number' => $data['partnership']['phone_number'],
                        'state' => '',
                        'zip_code' => '',
                        'phone_password' => $phone_password
                    );
                    $webservice_config = array(
                        'server' => 'live_new'
                    );
                    $WebService = new WebService($webservice_config);
                    $WebService->open_account_standard($service_data);
                    if( $WebService->request_status === 'RET_OK' ) {

                        $reference_number = $WebService->get_result('LogIn');
                        $TraderPassword = $WebService->get_result('TraderPassword');
                        $partnership_details = array(
                            'reference_num' => $reference_number,
                            'phone_number' => $data['partnership']['phone_number'],
                            'target_country' => $data['partnership']['target_country'],
                            'message' => $data['partnership']['message'],
                            'websites' => $websites,
                            'type_of_partnership' => $data['partnership']['type_of_partnership'],
                            'status_type' => $data['partnership']['status_type'],
                            'company_name' => $data['partnership']['company_name'],
                            'registration_number' => $data['partnership']['registration_number'],
                            'date_of_incorporation' => $data['partnership']['date_of_incorporation'],
                            'partner_id' => $partner_id,
                            'currency' => $data['partnership']['currency'],
                            'phone_password' => $phone_password,
                            'trader_password' =>$TraderPassword
                        );

                        $this->general_model->insert('partnership', $partnership_details);
                        $data['partnership_affiliate_code'] = $this->general_model->showssingle($table='partnership_affiliate_code',$id='partner_id', $field= $data['partnership']['partner_id'],$select='*');

                        $partnership_affiliate = array(
                            'partner_id' => $partner_id,
                            'affiliate_code' => $data['partnership_affiliate_code']['affiliate_code']
                        );
                        $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                        $partnership_authdetails = array(
                            'email' =>  $data['users']['email'],
                            'password' => $generatePass,
                            'fullname' => $data['user_profiles']['full_name'],
                            'phone_password' => $phone_password,
                            'account_number'=>$reference_number,
                            'trader_password' =>$TraderPassword
                        );

                        /*table update to recreate accounts*/
                        $data['email1'] =   $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
                        $data['email2'] =   $this->fx_mailer->partnersdetails($data['users']['email'], $partnership_details, $profile);

                        $data['logemailsent']=array(
                            'account_number' => $reference_number,
                            'email1' => ($data['email1']==true)? 1:2,
                            'email2' => ($data['email2']==true)? 1:2,
                            'type' => 1,
                            'no_user_profiles' => 1
                        );

                        $this->g_m->insertmy($table='recreated_accounts', $data['logemailsent']);
                        /*table update to recreate accounts*/
                        $data['oldaccount']=array(
                            'partner_id' => $data['partnership']['partner_id'],
                            'affiliate_code' => ''
                        );

                        $this->g_m->updatemy($table="partnership_affiliate_code","partner_id",$data['partnership']['partner_id'], $data['oldaccount']);

                        $this->db->trans_complete();

                    }else{

                        $this->db->trans_rollback();
                    }
                    session_unset();
                    unset ($data);
                }else{
                    $data['logemailsent']=array(
                        'old_account_number' => $value,
                        'email1' => 0,
                        'email2' => 0,
                        'type' => 1,
                        'no_user_profiles'=>1
                    );
                    $this->g_m->insertmy($table='recreated_accounts', $data['logemailsent']);
                    $this->db->trans_complete();
                }

            }

        }

    }

    public function live(){
die();

        if (IPLoc::Office_and_Vpn()){

            $this->load->library('tank_auth');
            $this->lang->load('tank_auth');
            $this->lang->load('register');
            $this->lang->load('live-account-html');
            $this->country_code = FXPP::getUserCountryCode() or null;
            foreach($this->live as $key => $value ){

//                $this->db->trans_start();

                    $data['mt_accounts_set'] = $this->general_model->showssingle($table='mt_accounts_set',$id='account_number', $field=$value,$select='*');
                              $data['users'] = $this->general_model->showssingle($table='users',$id='id', $field= $data['mt_accounts_set']['user_id'] ,$select='*');
                      $data['user_profiles'] = $this->general_model->showssingle($table='user_profiles',$id='user_id', $field= $data['mt_accounts_set']['user_id'] ,$select='*');
                           $data['contacts'] = $this->general_model->showssingle($table='contacts',$id='user_id', $field= $data['mt_accounts_set']['user_id'] ,$select='*');

                    $login_type = 0;
                    $use_username = $this->config->item('use_username', 'tank_auth');
                    $email_activation = $this->config->item('email_activation', 'tank_auth');

                    $user_inser_data = $this->tank_auth->create_user(
                        $use_username ? $this->form_validation->set_value('username') : '',
                        $data['users']['email'],
                        $data['mycode'] = $this->GetCode(10),
                        $email_activation, 1, $login_type
                    );

                $user_id = $user_inser_data['user_id'];
                $user_data = array(
                    'user_id' => $user_id,
                );

                $this->session->set_userdata($user_data);

                $data['random_alpha_string_analytics'] = '';
                $data['random_alpha_string_analytics'] = 'z42esbsn4yqu2p';
                $data['save_hash'] = array(
                    'first_login_hash' => $data['random_alpha_string_analytics'],
                    'first_login_stat' => 1,
                    'registration_location'=>1,
                );

                $this->general_model->update('users', 'id', $user_id, $data['save_hash']);

                $user_data = array(
                    'analytic_hash' => $data['random_alpha_string_analytics'],
                );
                $this->session->set_userdata($user_data);
                $profile = array(
                    'full_name' => $data['user_profiles']['full_name'],
                    'user_id' => $user_id,
                    'country' => $data['user_profiles']['country'],
                    'street' =>  $data['user_profiles']['street'],
                    'city' => $data['user_profiles']['city'],
                    'state' => $data['user_profiles']['state'],
                    'zip' => $data['user_profiles']['zip'],
                    'dob' => $data['user_profiles']['dob'],
                );
                   if ($this->input->post('country', true) == 'PL') {
                       $_SESSION['temp_country'] = 'PL';
                   }

                $this->general_model->insert('user_profiles', $profile); // Insert into user profile data.

                $swap_free = $data['mt_accounts_set']['swap_free'];
                $swap_free = empty($swap_free) ? 0 : 1;
                $phone_password = FXPP::RandomizeCharacter(7);

                if(IPLoc::isChinaIP() || $data['user_profiles']['country'] == 'CN' || FXPP::html_url() == 'zh' ){
                    $this->session->set_userdata('isChina', '1');
                }

                $speardGroup = 1;  // Here store spread of value using affiliateChecker hook.
                $mt_set_id = $data['mt_accounts_set']['mt_account_set_id'];
                $speardGroup = $mt_set_id==1? "refSt".$speardGroup:"refZe".$speardGroup;

                if(!$this->general_model->getGroupSpard($speardGroup)){

                    $groupCurrency = $this->general_model->getGroupCurrency((int)$mt_set_id, $data['mt_accounts_set']['mt_currency_base'], $swap_free).'1';


                }else{

                    $groupCurrency = $speardGroup;

                }

                /*  =============== End Spread project  setting ================================ */

                $data['users_affiliate_code'] = $this->general_model->showssingle($table='users_affiliate_code',$id='users_id', $field= $data['users']['id'],$select='*');
                $generateAffiliateCode = FXPP::GenerateRandomAffiliateCode();
                $affiliate_code_data = array(
                    'users_id' => $user_id,
                    'affiliate_code' => ($data['users_affiliate_code']['affiliate_code']!=null)? $data['users_affiliate_code']['affiliate_code'] :$generateAffiliateCode
                );

                $this->general_model->insert('users_affiliate_code', $affiliate_code_data);

                $service_data = array(

                    'address' => $data['user_profiles']['street'],
                       'city' => $data['user_profiles']['city'],
                    'country' => $this->general_model->getCountries( $data['user_profiles']['country']) ,
                      'email' => $data['users']['email'],
                      'group' => $groupCurrency,

                   'leverage' => count($ex_leverage = explode(":",$data['mt_accounts_set']['leverage'])) > 1 ? $ex_leverage[1] : 1,

                       'name' => $data['user_profiles']['full_name'],
               'phone_number' => ($data['contacts']['phone1'])?$data['contacts']['phone1']:'',

                      'state' => $data['user_profiles']['state'],
                   'zip_code' => $data['user_profiles']['zip'],
             'phone_password' => $phone_password,
                    'comment' => strtolower(FXPP::html_url()) . ':' .  $data['mt_accounts_set']['registration_ip'] . ' recreatedaccount'

                );
                $webservice_config = array(
                    'server' => 'live_new'
                );
                $WebService = new WebService($webservice_config);
                $WebService->open_account_standard($service_data);

                if ($WebService->request_status === 'RET_OK') {
                    $AccountNumber = $WebService->get_result('LogIn');
                    $TraderPassword = $WebService->get_result('TraderPassword');
                    $InvestorPassword = $WebService->get_result('InvestorPassword');
                    $WebService4 = new WebService($webservice_config);
                    $account_info2 = array(
                        'iLogin' =>  $AccountNumber
                    );

                    $WebService4->request_account_details($account_info2);
                    if( $WebService4->request_status === 'RET_OK'){
                        $RegDate = $WebService4->get_result('RegDate');
                    }else{
                        $RegDate  = FXPP::getServerTime();
                    }

                    $mt_account = array(
                        'leverage' => $data['mt_accounts_set']['leverage'],
                        'registration_leverage' => $data['mt_accounts_set']['registration_leverage'],
                        'amount' => 0,
                        'mt_currency_base' => $data['mt_accounts_set']['mt_currency_base'],
                        'mt_account_set_id' => $data['mt_accounts_set']['mt_account_set_id'],
                        'registration_ip' => $data['mt_accounts_set']['registration_ip'],
                        'registration_time' => date('Y-m-d H:i:s', strtotime($RegDate)),
                        'user_id' => $user_id,
                        'mt_type' => 1,
                        'swap_free' => $swap_free,
                        'account_number' => $AccountNumber,
                        'trader_password' => $TraderPassword,
                        'investor_password' => $InvestorPassword,
                        'phone_password' => $phone_password
                    );
                    $this->general_model->insert('mt_accounts_set', $mt_account);

                    $this->g_m->updatemy($table = "users", "id", $user_id, array('created' => date('Y-m-d H:i:s', strtotime($RegDate))));

                    $getCookieAffiliate = '';
                    $forexmart_affiliate = '';

                    $data['trading_experience'] = $this->general_model->showssingle($table='trading_experience',$id='user_id', $field= $data['mt_accounts_set']['user_id'] ,$select='*');

                    $trading_experience = array(
                        'investment_knowledge' => $data['trading_experience']['investment_knowledge'],
                                        'risk' => $data['trading_experience']['risk'],
                                  'experience' => $data['trading_experience']['experience'],
                                     'user_id' => $user_id,
                          'technical_analysis' => $data['trading_experience']['technical_analysis'],
                              'trade_duration' => $data['trading_experience']['trade_duration'],
                    );

                    $this->general_model->insert('trading_experience', $trading_experience);

                    $contacts_data = array(
                        'phone1' => $data['contacts']['phone1'],
                        'user_id' => $user_id
                    );

                    $this->general_model->insert('contacts', $contacts_data);

                    // send email  to user email
                    $email_data = array(
                        'full_name' =>  $data['user_profiles']['full_name'],
                            'email' => $data['users']['email'],
                         'password' => $data['mycode'],
                   'account_number' => $mt_account['account_number'],
                  'trader_password' => $mt_account['trader_password'],
                'investor_password' => $mt_account['investor_password'],
                   'phone_password' => $mt_account['phone_password'],

                    );
                    $subject = lang('liv_acc_htm_00'); //"ForexMart MT4 Live Trading Account details";
                    $config = array(
                        'mailtype' => 'html'
                    );

                    $isSendSuccess = $this->general_model->sendEmail('live-account-html', $subject, $email_data['email'], $email_data,$config);
                    if($isSendSuccess){
                        $fullname = $data['user_profiles']['full_name'];
                        $email = $data['users']['email'];
                        FXPP::createPeriodicMailer($email, $fullname);
                        $data['logemailsent']=array(
                            'account_number' => $mt_account['account_number'],
                            'email1' => 1,
                            'type' => 0,
                            'old_account_number'=>$value
                        );
                        $this->g_m->insertmy($table='recreated_accounts', $data['logemailsent']);
                    }


                    /*table update to recreate accounts*/
                    $data['oldaccount']=array(
                        'users_id' => $data['mt_accounts_set']['users_id'],
                        'affiliate_code' =>  FXPP::GenerateRandomAffiliateCode()
                    );
                    $this->g_m->updatemy($table="users_affiliate_code","users_id",$data['mt_accounts_set']['user_id'], $data['oldaccount']);

                    $this->dailyCountryReport($user_id);

                    $data['employment_details'] = $this->general_model->showssingle($table='employment_details',$id='user_id', $field= $data['mt_accounts_set']['user_id'] ,$select='*');


                    $employment_detail = array(
                        'employment_status' => $data['employment_details']['employment_status'],
                        'industry' => $data['employment_details']['industry'],
                        'source_of_funds' => $data['employment_details']['source_of_funds'],
                        'estimated_annual_income' => $data['employment_details']['estimated_annual_income'],
                        'estimated_net_worth' => $data['employment_details']['estimated_net_worth'],
                        'politically_exposed_person' => $data['employment_details']['politically_exposed_person'],
                        'education_level' => $this->input->post('education_level', true),
                        'us_resident' => $data['employment_details']['us_resident'],
                        'us_citizen' => $data['employment_details']['us_citizen'],
                        'user_id' => $user_id
                    );

                    $this->general_model->insert('employment_details', $employment_detail);

//                    $this->db->trans_complete();


                }else{


                    echo ' service error';
//                    $this->db->trans_rollback();

                    $data['logemailsent']=array(
                        'old_account_number' => $value,
                        'email1' => 0,
                        'email2' => 0,
                        'type' => 0,
                        'no_user_profiles'=>0
                    );
                    $this->g_m->insertmy($table='recreated_accounts', $data['logemailsent']);

                }

                session_unset();
                unset ($data);
            }

        }

    }

    private function GetCode($length) {
        $key = '';
        $keys = array_merge(range(0, 9),range('A', 'Z'),range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public function checktestaccount_demo(){
        if (IPLoc::Office_and_Vpn()){
            die();
            $test = array();
            $real = array();
            foreach($this->demo as $key => $value ){
                $data['mtas'] = $this->general_model->showssingle($table='mt_accounts_set',$id='account_number', $field=$value,$select='user_id');
                $data['check'] = $this->general_model->showssinglesecond($table='users', $field1 = "id", $id1 = $data['mtas']['user_id'], $field2 = "test", $id2 = "1", $field3 = "test_1", $id3 = "0", $select = "*", $order_by = "");
                if ($data['check']){
                    array_push($test, $value);
                }else{
                    array_push($real, $value);
                }
            }
            echo 'test';
            var_dump($test);
            echo 'real';
            var_dump($real);
        }
    }

    public function checktestaccount_live(){

        if (IPLoc::Office_and_Vpn()){
            die();
            $test = array();
            $real = array();
            foreach($this->live as $key => $value ){
                $data['mtas'] = $this->general_model->showssingle($table='mt_accounts_set',$id='account_number', $field=$value,$select='user_id');
                $data['check'] = $this->general_model->showssinglesecond($table='users', $field1 = "id", $id1 = $data['mtas']['user_id'], $field2 = "test", $id2 = "1", $field3 = "test_1", $id3 = "0", $select = "*", $order_by = "");
                if ($data['check']){
                    array_push($test, $value);
                }else{
                    array_push($real, $value);
                }

            }
            echo 'test';
            var_dump($test);
            echo 'real';
            var_dump($real);
        }
    }

    public function checktestaccount_partner(){
        if (IPLoc::Office_and_Vpn()){
            die();
            $test = array();
            $real = array();
            foreach($this->partner as $key => $value ){
                $data['p'] = $this->general_model->showssingle($table='partnership',$id='reference_num', $field=$value,$select='partner_id');
                $data['check'] = $this->general_model->showssinglesecond($table='users', $field1 = "id", $id1 = $data['p']['partner_id'], $field2 = "test", $id2 = "1", $field3 = "test_1", $id3 = "0", $select = "*", $order_by = "");

                if ($data['check']){
                    array_push($test, $value);
                }else{
                    array_push($real, $value);
                }

            }
            echo 'test';
            var_dump($test);
            echo 'real';
            var_dump($real);
        }
    }


    public function dailyCountryReport($user_id)
    {

        $this->load->model('account_model');
        $this->load->model('general_model');


        if ($row = $insert_data['client_country'] = $this->account_model->getClientInfoByUserId($user_id)) {
            $c_code = $row[0]->country;


            $insert_data['country'] = $this->general_model->getCountries();
            $insert_data['country']["GB','IE"] = "UK and Ireland ";
            $insert_data['country']["AT','DE"] = "Austria and Germany ";
            $insert_data['country']["AM','BY','KZ','KG','MD','RU','TJ','TM','UA"] = "Russia and CIS";

            $to_email = array(
                "ES" => 'clients_spain_daily_1@forexmart.com',
                "AT" => 'clients_germany_daily_1@forexmart.com',
                "DE" => 'clients_germany_daily_1@forexmart.com',
                "FR" => 'clients_france_daily_1@forexmart.com',
                "GB" => 'clients_ukireland_daily_1@forexmart.com',
                "IE" => 'clients_ukireland_daily_1@forexmart.com',
                "BG" => 'clients_bulgaria_daily_1@Forexmart.com',
                "CA" => 'clients_ukireland_daily_1@forexmart.com',
                "NL" => 'clients_ukireland_daily_1@forexmart.com',
                "AM" => 'clients_russia_daily_1@forexmart.com',
                "BY" => 'clients_russia_daily_1@forexmart.com',
                "KZ" => 'clients_russia_daily_1@forexmart.com',
                "KG" => 'clients_russia_daily_1@forexmart.com',
                "MD" => 'clients_russia_daily_1@forexmart.com',
                "RU" => 'clients_russia_daily_1@forexmart.com',
                "TJ" => 'clients_russia_daily_1@forexmart.com',
                "TM" => 'clients_russia_daily_1@forexmart.com',
                "UA" => 'clients_russia_daily_1@forexmart.com',
                "UZ" => 'clients_russia_daily_1@forexmart.com',
                "PL" => 'clients_poland_daily_1@forexmart.com',
                "SK" => 'clients_czech.slovak_daily_1@forexmart.com',
                "CZ" => 'clients_czech.slovak_daily_1@forexmart.com',
                "IN" => "clients_india_daily_1@forexmart.com",
                "PK" => "clients_pakistan_daily_1@forexmart.com",
                "CF" => "clients_africa_daily_1@forexmart.com",
                "JM" => "clients_jamaica_daily_1@forexmart.com",
                "AU" => "clients_australia_daily_1@forexmart.com",
                "NZ" => "clients_australia_daily_1@forexmart.com",
                "MT" => "clients_malta_daily_1@forexmart.com",
                "SG" => "clients_singapore_daily_1@forexmart.com",
                "UZ" => "clients_uzbekistan_daily_1@forexmart.com",
                "TN" => "clients_france_daily_1@forexmart.com",
                "MA" => "clients_france_daily_1@forexmart.com",
                "MD" => "clients_moldavia_daily_1@forexmart.com",
                "RO" => "clients_romania_daily_1@forexmart.com",


            );


            // $insert_data['email'] = "fin-stats@forexmart.com";
            // $insert_data['email'] = "moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com";

            if (isset($to_email[$c_code])) {

                if ($to_email[$c_code] == "clients_russia_daily_1@forexmart.com") {
                    /* if ($this->account_model->getCISRegPerDay() % 2 == 0) {
                        $insert_data['email'] = "clients_russia_daily_1@forexmart.com";
                    } else {
                        $insert_data['email'] = "clients_russia_daily_2@forexmart.com";
                    }*/


                    if ($exGroup = $this->general_model->where("cis_group_mail", array('email' => $row[0]->email))) {

                        $insert_data['email'] = "clients_russia_daily_" . $exGroup->row()->group_id . "@forexmart.com";
                        $this->general_model->insertmy('cis_group_mail_list', array('account_number' => $row[0]->account_number, 'group_id' => $exGroup->row()->group_id));

                    } else {

                        $val = $this->account_model->getCISRegPerDay() % 5;
                        if ($val == 0) {
                            $insert_data['email'] = "clients_russia_daily_5@forexmart.com";
                            $this->general_model->insertmy('cis_group_mail', array('email' => $row[0]->email, 'group_id' => 5));
                            $this->general_model->insertmy('cis_group_mail_list', array('account_number' => $row[0]->account_number, 'group_id' => 5));
                        } else {
                            $insert_data['email'] = "clients_russia_daily_" . $val . "@forexmart.com";
                            $this->general_model->insertmy('cis_group_mail', array('email' => $row[0]->email, 'group_id' => $val));
                            $this->general_model->insertmy('cis_group_mail_list', array('account_number' => $row[0]->account_number, 'group_id' => $val));
                        }

                        /*if ($this->account_model->getCISRegPerDay() % 2 == 0) {

                            $insert_data['email'] = "clients_russia_daily_1@forexmart.com";
                            $this->general_model->insertmy('cis_group_mail',array('email'=>$row[0]->email,'group_id'=>1));

                        } else {

                             $insert_data['email'] = "clients_russia_daily_2@forexmart.com";
                            $this->general_model->insertmy('cis_group_mail',array('email'=>$row[0]->email,'group_id'=>2));
                        }*/

                    }


                } else {
                    $insert_data['email'] = $to_email[$c_code];
                }

            } else {
                return true;
                $insert_data['email'] = "german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
            }


            $insert_data['subject'] = "Clients from " . $insert_data['country'][$c_code] . " on  " . date('Y-m-d');
            $config = array(
                'mailtype' => 'html'
            );


            $this->load->library('email');
            if ($config != null) {
                $this->email->initialize($config);
            }
            $this->SMTPDebug = 1;
            $this->email->from('noreply@mail.forexmart.com', 'ForexMart');
            //  $this->email->reply_to('noreply@mail.forexmart.com', 'ForexMart');
            $this->email->to($insert_data['email']);
            //  $this->email->to("moniruzzaman-it@itgrowtech.com,bug.fxpp@gmail.com");

            if (isset($to_email[$c_code])) {
                $this->email->bcc('german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com,pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,bug.fxpp@gmail.com');
            } else {
                // $insert_data['email'] ="german.pavlyak@forexmart.com,agus@forexmart.com,ildar.sharipov@forexmart.com";
                $this->email->bcc('pmtest1@groups.forexmart.com,pptest1@groups.forexmart.com,agus@forexmart.com,bug.fxpp@gmail.com');
            }


            $this->email->subject($insert_data['subject']);
            $this->email->message($this->load->view('email/realtime_client_report', $insert_data, TRUE));
            $this->email->send();
        }

    }
    public function gencode(){
        echo  FXPP::GenerateRandomAffiliateCode();

    }

    public function replace_affiliatecode_oldaccounts(){

        die();
        $this->load->model('General_model');
        $this->g_m = $this->General_model;

        $this->live2 = array(
//            '1035'
//            '1036'
        );

        foreach($this->live as $key => $value ){
            $data['mt_accounts_set'] = $this->general_model->showssingle($table='mt_accounts_set',$id='account_number', $field=$value,$select='*');
            $data['users_affiliate_code'] = $this->general_model->showssingle($table='users_affiliate_code',$id='users_id', $field= $data['mt_accounts_set']['user_id'],$select='*');
            if (in_array( $data['users_affiliate_code']['affiliate_code'], $this->affiliatecode)) {
                    echo 'account number '.$value .'user_id '.$data['mt_accounts_set']['user_id'].' affiliate code'  . $data['users_affiliate_code']['affiliate_code']. '<br/>';
                    $data['oldaccount']=array(
                        'users_id' => $data['mt_accounts_set']['user_id'],
                        'affiliate_code' =>  $new=FXPP::GenerateRandomAffiliateCode()
                    );
                    $this->g_m->updatemy($table="users_affiliate_code","users_id",$data['mt_accounts_set']['user_id'], $data['oldaccount']);
                    echo '-account_number'. $value .'new affiliate code '. $new.' <br/>';
            }else{

                echo 'account number '.$value .' affiliate code' . 'not '. '<br/>';
            }
        }

    }
    public function Trig_delete(){
            die();
        $this->load->model('General_model');

        $this->g_m = $this->General_model;
        $this->livedeleteX = array(
//            '1035'
//            '1031',
//            '1032',
        );

        $this->livedelete = array(
            '1033',
            '1034',
            '1036',
            '1037',
            '1038',
            '1040',
            '1041',
            '1042',
            '1043',
            '1044',
            '1045',
            '1046',
            '1047',
            '1048',
            '1049',
            '1050',
            '1051',
            '1052',
            '1053',
            '1054',
            '1055',
            '1056',
            '1057',
            '1059',
            '1060',
            '1061',
            '1062',
            '1063',
            '1064',
            '1065',
            '1066',
            '1067',
            '1068',
            '1069',
            '1071',
            '1072',
            '1073',
            '1074',
            '1075',
            '1076',
            '1077',
            '1078',
            '1079',
            '1080',
            '1081',
            '1082',
            '1084',
            '1085',
            '1088',
            '1089',
            '1090',
            '1091',
            '1092',
            '1093',
            '1094',
            '1095',
            '1096',
            '1097',
            '1098',
            '1099',
            '1100',
            '1101',
            '1102',
            '1103',
            '1104',
            '1105',
            '1106',
            '1107',
            '1108',
            '1109',
            '1110',
            '1111',
            '1112',
            '1113',
            '1114',
            '1115',
            '1116',
            '1117',
            '1118',
            '1119',
            '1120',
            '1121',
            '1122',
            '1123',
            '1124',
            '1125',
            '1126',
            '1127',
            '1128',
            '1129',
            '1130',
            '1131',
            '1132',
            '1133',
            '1134',
            '1135',
            '1136',
            '1137',
            '1138',
            '1139',
            '1140',
            '1141',
            '1142',
            '1143',
            '1144',
            '1145',
            '1146',
            '1147',
            '1148',
            '1149',
            '1150',
            '1151',
            '1152',
            '1153',
            '1154',
            '1155',
            '1156',
            '1157',
            '1158',
            '1159',
            '1160',
            '1161',
            '1162',
            '1163',
            '1164',
            '1165',
            '1166',
            '1167',
            '1168',
            '1169',
            '1170',
            '1171',
            '1172',
            '1173',
            '1174',
            '1175',
            '1176',
            '1177',
            '1178',
            '1179',
            '1180',
            '1181',
            '1182',
            '1183',
            '1184',
            '1185',
            '1186',
            '1187',
            '1188',
            '1189',
            '1190',
            '1191',
            '1192',
            '1193',
            '1194',
            '1195',
            '1196',
            '1197',
            '1198',
            '1199',
            '1200',
            '1201',
            '1202',
            '1203',
            '1204',
            '1205',
            '1207',
            '1208',
            '1209',
            '1210',
            '1211',
            '1212',
            '1213',
            '1214',
            '1215',
            '1216',
            '1217',
            '1218',
            '1219',
            '1220',
            '1221',
            '1222',
            '1223',
            '1224',
            '1225',
            '1226',
            '1227',
            '1228',
            '1229',
            '1230',
            '1231',
            '1232',
            '1233',
            '1234',
            '1235',
            '1236',
            '1237',
            '1238',
            '1239',
            '1240',
            '1241',
            '1242',
            '1243',
            '1244',
            '1245',
            '1246',
            '1247',
            '1248',
            '1249',
            '1250',
            '1251',
            '1252',
            '1253',
            '1254',
            '1255',
            '1256',
            '1257',
            '1258',
            '1259',
            '1260',
            '1261',
            '1262',
            '1263',
            '1264',
            '1265',
            '1266',
            '1267',
            '1268',
            '1269',
            '1270',
            '1271',
            '1272',
            '1273',
            '1274',
            '1275',
            '1276',
            '1277',
            '1278',
            '1279',
            '1280',
            '1281',
            '1282',
            '1283',
            '1284',
            '1285',
            '1286',
            '1287',
            '1288',
            '1289',
            '1290',
            '1291',
            '1292',
            '1293',
            '1294',
            '1295',
            '1296',
            '1297',
            '1298',
            '1300',
            '1301',
            '1302',
            '1303',
            '1304',
            '1305',
            '1306',
            '1307',
            '1308',
            '1309',
            '1310',
            '1311',
            '1312',
            '1313',
            '1314',
            '1315',
            '1318',
            '1320',
            '1322',
            '1323',
            '1025',
            '1324',
            '1325',
            '1326',
            '1327',
            '1335',
            '1336',
            '1338',
            '1339',
            '1340',
            '1341',
            '1342',
            '1343',
            '1344',
            '1345',
            '1346',
            '1347',
            '1348',
            '1027',
            '1349',
            '1350',
            '1351',
            '1353',
            '1354',
            '1355',
            '1356',
            '1357',
            '1358',
            '1359',
            '1360',
            '1361',
            '1362',
            '1363',
            '1364',
            '1365',
            '1366',
            '1367',
            '1368',
            '1369',
            '1370',
            '1371',
            '1372',
            '1373',
            '1374',
            '1375',
            '1376',
            '1377',
            '1378',
            '1379',
            '1380',
            '1381',
            '1382',
            '1383',
            '1384',
            '1385',
            '1028',
            '1387',
            '1388',
            '1389',
            '1390',
            '1391',
            '1392',
            '1393',
            '1394',
            '1395',
            '1396',
            '1397',
            '1398',
            '1399',
            '1400',
            '1029',
            '1401',
            '1402',
            '1403',
            '1404',
            '1405',
            '1406',
            '1407',
            '1408',
            '1409',
            '1410',
            '1411',
            '1412',
            '1413',
            '1414',
            '1415',
            '1416',
            '1417',
            '1418',
            '1419',
            '1420',
            '1421',
            '1422',
            '1423',
            '1424',
            '1425',
            '1426',
            '1427',
            '1428',
            '1429',
            '1430',
            '1431',
            '1432',
            '1433',
            '1434',
            '1435',
            '1436',
            '1437',
            '1438',
            '1439',
            '1034',
            '1440',
            '1441',
            '1442',
            '1443',
            '1444',
            '1445',
            '1446',
            '1447',
            '1448',
            '1449',
            '1451',
            '1452',
            '1453',
            '1454',
            '1455',
            '1456',
            '1457',
            '1458',
            '1035',
            '1459',
            '1460',
            '1461',
            '1462',
            '1463',
            '1464',
            '1465',
            '1036',
            '1466',
            '1468',
            '1469',
            '1470',
            '1471',
            '1472',
            '1473',
            '1474',
            '1475',
            '1476',
            '1477',
            '1478',
            '1479',
            '1480',
            '1481',
            '1482',
            '1483',
            '1484',
            '1485',
            '1486',
            '1487',
            '1488',
            '1489',
            '1490',
            '1037',
            '1491',
            '1492',
            '1493',
            '1494',
            '1495',
            '1496',
            '1497',
            '1498',
            '1499',
            '1500',
            '1501',
            '1502',
            '1503',
            '1504',
            '1505',
            '1506',
            '1507',
            '1508',
            '1509',
            '1510',
            '1511',
            '1512',
            '1038',
            '1513',
            '1514',
            '1515',
            '1516',
            '1517',
            '1518',
            '1519',
            '1520',
            '1521',
            '1522',
            '1523',
            '1524',
            '1525',
            '1526',
            '1527',
            '1528',
            '1529',
            '1530',
            '1531',
            '1532',
            '1533',
            '1534',
            '1535',
            '1536',
            '1537',
            '1538',
            '1539',
            '1540',
            '1541',
            '1039',
            '1542',
            '1543',
            '1544',
            '1545',
            '1546',
            '1547',
            '1548',
            '1549',
            '1550',
            '1551',
            '1552',
            '1553',
            '1554',
            '1040',
            '1555',
            '1556',
            '1557',
            '1558',
            '1559',
            '1560',
            '1561',
            '1041',
            '1562',
            '1563',
            '1564',
            '1565',
            '1566',
            '1567',
            '1568',
            '1042',
            '1569',
            '1043',
            '1570',
            '1571',
            '1572',
            '1573',
            '1044',
            '1045',
            '1574',
            '1575',
            '1576',
            '1577',
            '1578',
            '1046',
            '1579',
            '1580',
            '1581',
            '1582',
            '1583',
            '1584',
            '1585',
            '1586',
            '1587',
            '1588',
            '1589',
            '1590',
            '1591',
        );
        foreach($this->livedelete as $key => $value ){

            $this->db->trans_start();
            $data['mt_accounts_set'] = $this->general_model->showssingle($table='mt_accounts_set',$id='account_number', $field=$value,$select='*');
//            var_dump($data['mt_accounts_set']['user_id']);
            $return = $this->g_m->deletemy($table='mt_accounts_set', $field='user_id', $id=  $data['mt_accounts_set']['user_id']);

            if($return){
                $data['log_deleted']=array(
                    'account_number' => $data['mt_accounts_set']['account_number'],
                    'user_id' => $data['mt_accounts_set']['user_id'],
                );

                $this->g_m->insertmy($table='log_deleted_mtaccountsset',  $data['log_deleted']);

                $this->db->trans_complete();

            }else{

                $this->db->trans_rollback();

            }

        }
    }

    public function check_ptype(){
            die();
        foreach($this->partner as $key => $value ){
            $data['partnership'] = $this->general_model->showssingle($table='partnership',$id='reference_num', $field=$value,$select='*');

            echo 'Account number: '.$data['partnership']['reference_num']. ' partnership type: '. $data['partnership']['type_of_partnership'] . '<br/>';

        }

    }

    public function addpartner_test(){
        die();

        $this->load->library('fx_mailer');
        $this->load->library('tank_auth');
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->lang->load('tank_auth');
        $this->g_m = $this->general_model;
        $this->js = $this->template->Js();
        $this->load->helper('string');
        $this->country_code = FXPP::getUserCountryCode() or null;
        $this->lang->load('partnership');
        $this->nlanguage = FXPP::html_url();
        $this->partner_add_db =array(
            '108496'
        );

        foreach($this->partner_add_db as $key => $value ){

            $data['partnership'] = $this->general_model->showssingle($table='partnership',$id='reference_num', $field=$value,$select='*');
            $data['users'] = $this->general_model->showssingle($table='users',$id='id', $field= $data['partnership']['partner_id'],$select='*');
            $data['user_profiles'] = $this->general_model->showssingle($table='user_profiles',$id='user_id', $field= $data['partnership']['partner_id'],$select='*');
            $data['contacts'] = $this->general_model->showssingle($table='contacts',$id='user_id', $field= $data['partnership']['partner_id'],$select='*');

            var_dump($data['partnership']);
            echo '<br/>';
            var_dump($data['users']);
            echo '<br/>';
            var_dump($data['user_profiles']);
            echo '<br/>';
            var_dump($data['contacts']);
            echo '<br/>';

//            die();


            $generatePass = FXPP::generateGUIDForgotPassword(8);
            $use_username = $this->config->item('use_username', 'tank_auth');
            $email_activation = $this->config->item('email_activation', 'tank_auth');
            $login_type = 1;

            $phone_password =  FXPP::RandomizeCharacter(7);
            $data['random_alpha_string_analytics']='z42esbsn4yqu2p';
            $data['save_hash'] = array(
                'first_login_hash' => $data['random_alpha_string_analytics'] ,
                'first_login_stat' => 1
            );
            $websites =  $data['partnership']['websites'];

            if(IPLoc::isChinaIP() || $data['user_profiles']['country'] == 'CN' || FXPP::html_url() == 'zh' ){
                $this->session->set_userdata('isChina', '1');
            }

            $groupCurrency = $this->general_model->getGroupCurrency(3,$data['partnership']['currency']);
            $service_data = array(
                'address' => '',
                'city' => '',
                'country' => $this->general_model->getCountries($data['user_profiles']['country']),
                'email' => $data['users']['email'],
                'group' => $groupCurrency,
                'leverage' => '',
                'name' => $data['user_profiles']['full_name'],
                'phone_number' => $data['partnership']['phone_number'],
                'state' => '',
                'zip_code' => '',
                'phone_password' => $phone_password
            );
            $webservice_config = array(
                'server' => 'live_new'
            );
            $WebService = new WebService($webservice_config);
            $WebService->open_account_standard($service_data);
            if( $WebService->request_status === 'RET_OK' ) {
                $reference_number = $WebService->get_result('LogIn');
                $TraderPassword = $WebService->get_result('TraderPassword');
                echo 'Account number: '.$reference_number .'<br/>';
                echo 'Trader Password: '. $TraderPassword .'<br/>';
                echo 'Phone Password: '. $phone_password .'<br/>';
                echo 'SUCCESS';
            }else{
                echo 'FAIL';
            }
        }
    }

    public function addpartner(){
        if (IPLoc::Office_and_Vpn()){
            die();
            $this->load->library('fx_mailer');
            $this->load->library('tank_auth');
            $this->load->model('user_model');
            $this->load->model('account_model');
            $this->lang->load('tank_auth');
            $this->g_m = $this->general_model;
            $this->js = $this->template->Js();
            $this->load->helper('string');
            $this->country_code = FXPP::getUserCountryCode() or null;
            $this->lang->load('partnership');
            $this->nlanguage = FXPP::html_url();
//1442990604

//            $this->partner_add_db =array(
//                '108496'
//            );
//            $reference_number='206890';


            $this->partner_add_db =array(
                '1442990604'
            );
            $reference_number='204524';


            foreach($this->partner_add_db as $key => $value ){

//                $this->db->trans_start();

                $data['partnership'] = $this->general_model->showssingle($table='partnership',$id='reference_num', $field=$value,$select='*');

                $data['users'] = $this->general_model->showssingle($table='users',$id='id', $field= $data['partnership']['partner_id'],$select='*');

                $data['user_profiles'] = $this->general_model->showssingle($table='user_profiles',$id='user_id', $field= $data['partnership']['partner_id'],$select='*');

                var_dump( $data['partnership']);
                echo '<br>';
                var_dump( $data['users'] );
                echo '<br>';
                var_dump( $data['user_profiles']);
                echo '<br>';


                if($data['user_profiles']){

                    $data['contacts'] = $this->general_model->showssingle($table='contacts',$id='user_id', $field= $data['partnership']['partner_id'],$select='*');

                    $generatePass = FXPP::generateGUIDForgotPassword(8);

                    $use_username = $this->config->item('use_username', 'tank_auth');

                    $email_activation = $this->config->item('email_activation', 'tank_auth');

                    $login_type = 1;

                    $phone_password =  FXPP::RandomizeCharacter(7);

                    $user_inser_data = $this->tank_auth->create_user(
                        $use_username,
                        $data['users']['email'] ,
                        $generatePass,
                        $email_activation,
                        1,
                        $login_type,
                        $phone_password
                    );

                    $partner_id = $user_inser_data['user_id'];

                    $data['random_alpha_string_analytics']='z42esbsn4yqu2p';

                    $data['save_hash'] = array(
                        'first_login_hash' => $data['random_alpha_string_analytics'] ,
                        'first_login_stat' => 1
                    );

                    $this->general_model->update('users', 'id', $partner_id, $data['save_hash']);

                    $profile = array(
                        'full_name' => $data['user_profiles']['full_name'],
                        'user_id' => $partner_id,
                        'country' => $data['user_profiles']['country'],
                        'skype' => $data['user_profiles']['skype']
                    );

                    $this->general_model->insert('user_profiles', $profile);

                    $websites =  $data['partnership']['websites'];

                    if(IPLoc::isChinaIP() || $data['user_profiles']['country'] == 'CN' || FXPP::html_url() == 'zh' ){
                        $this->session->set_userdata('isChina', '1');
                    }

                    $groupCurrency = $this->general_model->getGroupCurrency(3,$data['partnership']['currency']);

//                    $service_data = array(
//                        'address' => '',
//                        'city' => '',
//                        'country' => $this->general_model->getCountries($data['user_profiles']['country']),
//                        'email' => $data['users']['email'],
//                        'group' => $groupCurrency,
//                        'leverage' => '',
//                        'name' => $data['user_profiles']['full_name'],
//                        'phone_number' => $data['partnership']['phone_number'],
//                        'state' => '',
//                        'zip_code' => '',
//                        'phone_password' => $phone_password
//                    );
//                    $webservice_config = array(
//                        'server' => 'live_new'
//                    );
//                    $WebService = new WebService($webservice_config);
//                    $WebService->open_account_standard($service_data);
//                    if( $WebService->request_status === 'RET_OK' ) {

//                        $reference_number = $WebService->get_result('LogIn');
//                        $TraderPassword = $WebService->get_result('TraderPassword');
                        $partnership_details = array(
                            'reference_num' => $reference_number,
                            'phone_number' => $data['partnership']['phone_number'],
                            'target_country' => $data['partnership']['target_country'],
                            'message' => $data['partnership']['message'],
                            'websites' => $websites,
                            'type_of_partnership' => $data['partnership']['type_of_partnership'],
                            'status_type' => $data['partnership']['status_type'],
                            'company_name' => $data['partnership']['company_name'],
                            'registration_number' => $data['partnership']['registration_number'],
                            'date_of_incorporation' => $data['partnership']['date_of_incorporation'],
                            'partner_id' => $partner_id,
                            'currency' => $data['partnership']['currency'],
                            'phone_password' => $phone_password,
                            'trader_password' => '' //$TraderPassword
                        );

                        $this->general_model->insert('partnership', $partnership_details);
                        $data['partnership_affiliate_code'] = $this->general_model->showssingle($table='partnership_affiliate_code',$id='partner_id', $field= $data['partnership']['partner_id'],$select='*');

                        $partnership_affiliate = array(
                            'partner_id' => $partner_id,
                            'affiliate_code' => $data['partnership_affiliate_code']['affiliate_code']
                        );
                        $this->general_model->insert('partnership_affiliate_code', $partnership_affiliate);

                        $partnership_authdetails = array(
                            'email' =>  $data['users']['email'],
                            'password' => $generatePass,
                            'fullname' => $data['user_profiles']['full_name'],
                            'phone_password' => $phone_password,
                            'account_number'=>$reference_number,
                            'trader_password' =>''//$TraderPassword
                        );

                        /*table update to recreate accounts*/
//                        $data['email1'] =   $this->fx_mailer->partners_registration($partnership_authdetails, $partnership_affiliate);
//                        $data['email2'] =   $this->fx_mailer->partnersdetails($data['users']['email'], $partnership_details, $profile);

//                        $data['logemailsent']=array(
//                            'account_number' => $reference_number,
//                            'email1' => ($data['email1']==true)? 1:2,
//                            'email2' => ($data['email2']==true)? 1:2,
//                            'type' => 1,
//                            'no_user_profiles' => 1
//                        );

//                        $this->g_m->insertmy($table='recreated_accounts', $data['logemailsent']);
                        /*table update to recreate accounts*/
                        $data['oldaccount']=array(
                            'partner_id' => $data['partnership']['partner_id'],
                            'affiliate_code' => ''
                        );
                        $this->g_m->updatemy($table="partnership_affiliate_code","partner_id",$data['partnership']['partner_id'], $data['oldaccount']);

                        $this->db->trans_complete();

//                    }else{
//
//                        $this->db->trans_rollback();
//                    }
                    session_unset();
                    unset ($data);
                }else{
//                    $data['logemailsent']=array(
//                        'old_account_number' => $value,
//                        'email1' => 0,
//                        'email2' => 0,
//                        'type' => 1,
//                        'no_user_profiles'=>1
//                    );
//                    $this->g_m->insertmy($table='recreated_accounts', $data['logemailsent']);
                    $this->db->trans_complete();
                }

            }

        }

    }

    public function ccode(){
        echo $this->country_code;
    }
    public function landing(){
//        echo 'test'; die();
        $this->landing = array(
            '221203',
            '221204',
            '221205',
            '221206',
            '221209',
            '221210',
            '221211',
            '221213',
            '221214',
            '221215',
            '221216',
            '221218',
            '221219',
            '221221',
            '221230',
            '221234',
            '221259',
            '221260',
            '221501',
            '221517',
            '221558',
            '221620',
            '221700',
            '222020',
            '223298',
            '223299',
            '226132',
            '226142',
            '226165',
            '226172',
            '226177'
        );

        $webservice_config = array(
            'server' => 'live_new'
        );

        $WebService = new WebService($webservice_config);

        $login_type = 0;

        $use_username = $this->config->item('use_username', 'tank_auth');

        $email_activation = $this->config->item('email_activation', 'tank_auth');

        foreach($this->landing as $key => $value ){

            $account_info2 = array(
                'iLogin' =>  $value
            );

            $WebService->request_account_details($account_info2);

            if( $WebService->request_status === 'RET_OK'){

                $s_email = $WebService->get_result('Email');

                $s_country = $WebService->get_result('Country');

                echo $value .' '. $s_email. ' '.$s_country .'<br/>';

//                $whereData = array('countryCode' => $this->country_code);
//
//                 $conndata = $this->general_model->getQueryStringRow('country_to_courrency', '*', $whereData);
//
//                $user_inser_data = $this->tank_auth->create_user(
//
//                    $use_username ? $this->form_validation->set_value('username') : '',
//                    $s_email,
//                    $data['mycode'] = $this->GetCode(10),
//                    $email_activation, 1, $login_type
//
//                );
//
//                $user_id = $user_inser_data['user_id'];
//
//                $this->load->helpers('url');
//
//                $reg_date = FXPP::getServerTime();
//
//                $swap_free = 0;
//
//                $phone_password = FXPP::RandomizeCharacter(7);
//
//                $groupCurrency = $this->general_model->getGroupCurrency(1, $currency, $swap_free);


            }else{

            }


        }




//        $whereData = array('countryCode' => $this->country_code);
//
//        $conndata = $this->general_model->getQueryStringRow('country_to_courrency', '*', $whereData);
//
//        if ($conndata->currencyCode != 'EUR' and $conndata->currencyCode != 'GBP' and $conndata->currencyCode != 'RUB') {
//            $currency = 'USD';
//        } else {
//            $currency = $conndata->currencyCode;
//        }


    }

}
