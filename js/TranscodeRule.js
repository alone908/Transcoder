var an = [];

an[33] = '!',
an[34] = '"',
an[35] = '#',
an[36] = '$',
an[37] = '%',
an[38] = '&',
an[39] = '\'',
an[40] = '(',
an[41] = ')',
an[42] = '*',
an[43] = '+',
an[44] = ',',
an[45] = '-',
an[46] = '.',
an[47] = '/',
an[48] = '0',
an[49] = '1',
an[50] = '2',
an[51] = '3',
an[52] = '4',
an[53] = '5',
an[54] = '6',
an[55] = '7',
an[56] = '8',
an[57] = '9',
an[58] = ':',
an[59] = ';',
an[60] = '<',
an[61] = '=',
an[62] = '>',
an[63] = '?',
an[64] = '@',
an[65] = 'A',
an[66] = 'B',
an[67] = 'C',
an[68] = 'D',
an[69] = 'E',
an[70] = 'F',
an[71] = 'G',
an[72] = 'H',
an[73] = 'I',
an[74] = 'J',
an[75] = 'K',
an[76] = 'L',
an[77] = 'M',
an[78] = 'N',
an[79] = 'O',
an[80] = 'P',
an[81] = 'Q',
an[82] = 'R',
an[83] = 'S',
an[84] = 'T',
an[85] = 'U',
an[86] = 'V',
an[87] = 'W',
an[88] = 'X',
an[89] = 'Y',
an[90] = 'Z',
an[91] = '[',
an[92] = '\\',
an[93] = ']',
an[94] = '^',
an[95] = '_',
an[96] = '`',
an[97] = 'a',
an[98] = 'b',
an[99] = 'c',
an[100] = 'd',
an[101] = 'e',
an[102] = 'f',
an[103] = 'g',
an[104] = 'h',
an[105] = 'i',
an[106] = 'j',
an[107] = 'k',
an[108] = 'l',
an[109] = 'm',
an[110] = 'n',
an[111] = 'o',
an[112] = 'p',
an[113] = 'q',
an[114] = 'r',
an[115] = 's',
an[116] = 't',
an[117] = 'u',
an[118] = 'v',
an[119] = 'w',
an[120] = 'x',
an[121] = 'y',
an[122] = 'z',
an[123] = '{',
an[124] = '|',
an[125] = '}',
an[126] = '~',
an[127] = '',
an[128] = '',
an[129] = '',
an[130] = '';

var TranscodeRule = {
  DataHead:{
    Blank:{
      Content:'=====',
      Exp:'=====',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:['undefined']
    },
    HeadTitle:{
      Content:'=====',
      Exp:'==表頭==',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:['undefined']
    },
    ITEM:{
      Content:'ITEM',
      Exp:'ITEM(資料項目)',
      length:4,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    OPEN_DATE:{
      Content:'OPEN_DATE',
      Exp:'開班資料日期',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    SOURCE_DATE:{
      Content:'SOURCE_DATE',
      Exp:'結班資料日期',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    FILE_SEQ:{
      Content:'FILE_SEQ',
      Exp:'資料檔序號',
      length:12,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    RECORD:{
      Content:'RECORD',
      Exp:'總筆數',
      length:20,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    TXN_VALUE_AMOUNT:{
      Content:'TXN_VALUE_AMOUNT',
      Exp:'總交易票值',
      length:24,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    TICKET_VALUE_AMOUNT:{
      Content:'TICKET_VALUE_AMOUNT',
      Exp:'總交易點數',
      length:24,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    Device_ID:{
      Content:'Device_ID',
      Exp:'裝置編號',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    BV_Transaction_Bathch_No:{
      Content:'BV_Transaction_Bathch_No',
      Exp:'批號',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Program_Version:{
      Content:'Program_Version',
      Exp:'程式版本',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Black_List_Version:{
      Content:'Black_List_Version',
      Exp:'黑名單版本',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal','UnixTime']
    },
    Parameter_Version:{
      Content:'Parameter_Version',
      Exp:'驗票機參數版本',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
},
DataBody:{
    Blank:{
      Content:'=====',
      Exp:'=====',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:['undefined']
    },
    BodyTitle:{
      Content:'=====',
      Exp:'==表身==',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:['undefined']
    },
    ITEM:{
      Content:'ITEM',
      Exp:'ITEM(資料項目)',
      length:4,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    Mifare_ID:{
      Content:'Mifare_ID',
      Exp:'Mifare_ID',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    SECTOR_1_BEFORE:{
      Content:'SECTOR_1_BEFORE',
      Exp:'交易前Sector 1 Block 0/1/2資料',
      length:96,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    SECTOR_3_BEFORE:{
      Content:'SECTOR_3_BEFORE',
      Exp:'交易前Sector 3 Block 0/1/2資料',
      length:96,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    APP_SECTOR_BEFORE:{
      Content:'APP_SECTOR_BEFORE',
      Exp:'交易前個別交易應用扇區(sector)資料',
      length:96,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    TRANS_NO:{
      Content:'TRANS_NO',
      Exp:'卡片交易序號',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    TRANS_DATE:{
      Content:'TRANS_DATE',
      Exp:'交易時間',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:true,
      Rule:['LSB','Decimal','UnixTime']
    },
    TRANS_TYPE:{
      Content:'TRANS_TYPE',
      Exp:'交易類別',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    BEFORE_BAL:{
      Content:'BEFORE_BAL',
      Exp:'交易前票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    TOPUP_AMT:{
      Content:'TOPUP_AMT',
      Exp:'交易票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    AFTER_BAL:{
      Content:'AFTER_BAL',
      Exp:'交易後票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    TRANS_SYS_NO:{
      Content:'TRANS_SYS_NO',
      Exp:'交易系統編號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    LOC_ID:{
      Content:'LOC_ID',
      Exp:'交易地點/運輸業者',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    DEV_ID:{
      Content:'DEV_ID',
      Exp:'交易機器/OBU編號',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    PID_CODE:{
      Content:'PID_CODE',
      Exp:'PID_CODE',
      length:16,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    LADA_AMT:{
      Content:'LADA_AMT',
      Exp:'LADA_AMT',
      length:16,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    LSNDSN_SEQ:{
      Content:'LSNDSN_SEQ',
      Exp:'LSNDSN_SEQ',
      length:16,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    RN:{
      Content:'RN',
      Exp:'RN',
      length:16,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    LTAC_PTAC:{
      Content:'LTAC_PTAC',
      Exp:'LTAC_PTAC',
      length:16,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    SAM_OSN:{
      Content:'SAM_OSN',
      Exp:'SAM序號',
      length:16,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    SAM_TRANS_SEQ:{
      Content:'SAM_TRANS_SEQ',
      Exp:'SAM的交易序號',
      length:12,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    SAM_MAC:{
      Content:'SAM_MAC',
      Exp:'SAM的交易驗證碼',
      length:16,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    TERM_TX_SEQ:{
      Content:'TERM_TX_SEQ',
      Exp:'終端設備交易序號',
      length:12,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    TERM_TX_DATE:{
      Content:'TERM_TX_DATE',
      Exp:'終端設備交易時間',
      length:28,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    TERM_ID:{
      Content:'TERM_ID',
      Exp:'終端設備編號',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    STORE_ID:{
      Content:'STORE_ID',
      Exp:'商店編號 /站別編號',
      length:30,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    TRANS_NO_CANCEL:{
      Content:'TRANS_NO_CANCEL',
      Exp:'交易被取消之卡片交易序號',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    TRANS_DATE_CANCEL:{
      Content:'TRANS_DATE_CANCEL',
      Exp:'交易被取消之交易日期',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:true,
      Rule:['LSB','Decimal','UnixTime']

    },
    APP_SECTOR_AFTER:{
      Content:'APP_SECTOR_AFTER',
      Exp:'交易後個別交易應用扇區(sector)資料',
      length:96,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    User_Type:{
      Content:'User_Type',
      Exp:'使用者型態',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Transfer_Favor_AMT:{
      Content:'Transfer_Favor_AMT',
      Exp:'轉乘優惠金額',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Original_Transaction_AMT:{
      Content:'Original_Transaction_AMT',
      Exp:'原票價金額',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    BV_Transaction_Bathch_No:{
      Content:'BV_Transaction_Bathch_No',
      Exp:'批號',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    in_Shuttle_Code:{
      Content:'in_Shuttle_Code',
      Exp:'去程之往返程代碼',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Value_Boarding_stop_Code:{
      Content:'Value_Boarding_stop_Code',
      Exp:'去程計費站代碼',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Boarding_Stop_Code:{
      Content:'Boarding_Stop_Code',
      Exp:'去程站序代碼(招呼站)',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    out_Shuttle_Code:{
      Content:'out_Shuttle_Code',
      Exp:'返程之往返程代碼',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Value_Alighting_stop_Code:{
      Content:'Value_Alighting_stop_Code',
      Exp:'出計費站代碼',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Alighting_Stop_Code:{
      Content:'Alighting_Stop_Code',
      Exp:'出站序代碼(招呼站)',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Transfer_Flag:{
      Content:'Transfer_Flag',
      Exp:'當次交易轉程旗標',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Cash_for_Insufficiunt:{
      Content:'Cash_for_Insufficiunt',
      Exp:'餘額不足收現金',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Bus_Lincense_ID:{
      Content:'Bus_Lincense_ID',
      Exp:'車牌號碼',
      length:12,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    Bus_Driver_ID:{
      Content:'Bus_Driver_ID',
      Exp:'駕駛編號/操作員編號',
      length:20,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    Bus_Route_Doman:{
      Content:'Bus_Route_Doman',
      Exp:'路線編號簡稱',
      length:12,
      dataCoding:'AN',
      LSB:false,
      UnixTime:false,
      Rule:['AN']
    },
    cust_date:{
      Content:'cust_date',
      Exp:'日結日',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    cust_date_class:{
      Content:'cust_date_class',
      Exp:'當日班別',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Total_Cash_Transaction_Amount:{
      Content:'Total_Cash_Transaction_Amount',
      Exp:'總現金錢包交易實扣額',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    FreeCode:{
      Content:'FreeCode',
      Exp:'中部公車使用',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    FreeBusRebate:{
      Content:'FreeBusRebate',
      Exp:'免費公車優待金額(中部公車使用)',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    price_margin:{
      Content:'price_margin',
      Exp:'票差優惠金額',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Total_Transaction_Fare:{
      Content:'Total_Transaction_Fare',
      Exp:'總應交易應扣額',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    PID:{
      Content:'PID',
      Exp:'儲值檔識別碼',
      length:16,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Card_Type:{
      Content:'Card_Type',
      Exp:'卡別',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Premium_Provider:{
      Content:'Premium_Provider',
      Exp:'發卡企業編號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Special_Identity_Original_Counter_Amount:{
      Content:'Special_Identity_Original_Counter/Amount',
      Exp:'敬老及特種之實扣點數/實扣次數',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Special_Identity_Usage_Counter_Accumulated_Amount:{
      Content:'Special_Identity_Usage_Counter/Accumulated_Amount',
      Exp:'敬老及特種之交易後點數/次數',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Special_Identity_Reset_Date:{
      Content:'Special_Identity_Reset_Date',
      Exp:'敬老及特種之重置日期(Unix Time)',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    Special_Identity_Activation_Date:{
      Content:'Special_Identity_Activation_Date',
      Exp:'敬老及特種之起始日(Unix Time)',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    Special_Identity_Expiration_Date:{
      Content:'Special_Identity_Expiration_Date',
      Exp:'敬老及特種之有效期(Unix Time)',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    Special_Identity_Departure_Station:{
      Content:'Special_Identity_Departure_Station',
      Exp:'特種票起站代碼',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Special_Identity_Arrival_Station:{
      Content:'Special_Identity_Arrival_Station',
      Exp:'特種票迄站代碼',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Special_Identity_Route_ID:{
      Content:'Special_Identity_Route_ID',
      Exp:'特種票路線編號',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Accumulated_Bonus_usage_status:{
      Content:'Accumulated_Bonus_usage_status',
      Exp:'紅利使用情形',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Accumulated_Bonus_valid_date:{
      Content:'Accumulated_Bonus_valid_date',
      Exp:'紅利有效期限',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Bonus_Purse_Sequence_Number:{
      Content:'Bonus_Purse_Sequence_Number',
      Exp:'紅利交易序號',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Bonus_Transaction_Amount:{
      Content:'Bonus_Transaction_Amount',
      Exp:'紅利消費點數',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Bonus_Remains:{
      Content:'Bonus_Remains',
      Exp:'紅利點數餘點',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Transfer_Group:{
      Content:'Transfer_Group',
      Exp:'轉乘(Flag)',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    Space:{
      Content:'Space',
      Exp:'保留',
      length:58,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
  }
}
