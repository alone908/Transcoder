var an = [];

an[32] = ' ',
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

var mef01 = {

    mef01_0:{
      Content:'mef01_0',
      Exp:'發行管理資料',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef01_1:{
      Content:'mef01_1',
      Exp:'發卡單位編號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_2:{
      Content:'mef01_2',
      Exp:'發卡設備編號',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_3:{
      Content:'mef01_3',
      Exp:'發行批號',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_4:{
      Content:'mef01_4',
      Exp:'發出日期',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    mef01_5:{
      Content:'mef01_5',
      Exp:'有效日期',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    mef01_6:{
      Content:'mef01_6',
      Exp:'卡片格式版本',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_7:{
      Content:'mef01_7',
      Exp:'卡片狀態',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_8:{
      Content:'mef01_8',
      Exp:'檢查碼',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_9:{
      Content:'mef01_09',
      Exp:'票值管理資料',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef01_10:{
      Content:'mef01_10',
      Exp:'自動加值設定',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_11:{
      Content:'mef01_11',
      Exp:'自動加值票值數額',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_12:{
      Content:'mef01_12',
      Exp:'儲存最大票值數額',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_13:{
      Content:'mef01_13',
      Exp:'每筆可加減最大票值數額',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_14:{
      Content:'mef01_14',
      Exp:'指定加值設定',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_15:{
      Content:'mef01_15',
      Exp:'指定加值票值數額',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_16:{
      Content:'mef01_16',
      Exp:'自動加值日期',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:true,
      Rule:['Decimal','UnixTime']
    },
    mef01_17:{
      Content:'mef01_17',
      Exp:'連續離線自動加值次數',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_18:{
      Content:'mef01_18',
      Exp:'連續自動加值次數',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_19:{
      Content:'mef01_19',
      Exp:'連續指定加值次數',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_20:{
      Content:'mef01_20',
      Exp:'檢查碼',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef01_21:{
      Content:'mef01_21',
      Exp:'卡片防偽驗證資料',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef01_22:{
      Content:'mef01_22',
      Exp:'防偽驗證資料',
      length:32,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },

}
console.log(mef01);
var mef03 = {
    mef03_0:{
      Content:'mef03_0',
      Exp:'卡片交易狀態資料',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef03_1:{
      Content:'mef03_1',
      Exp:'卡片交易序號',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_2:{
      Content:'mef03_2',
      Exp:'交易紀錄指標',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_3:{
      Content:'mef03_3',
      Exp:'優惠積點數',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_4:{
      Content:'mef03_4',
      Exp:'優惠積點交易序號',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_5:{
      Content:'mef03_5',
      Exp:'鎖卡旗標',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_6:{
      Content:'mef03_6',
      Exp:'進出閘門口編號',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_7:{
      Content:'mef03_7',
      Exp:'進出閘門口時間',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:true,
      Rule:['LSB','Decimal','UnixTime']
    },
    mef03_8:{
      Content:'mef03_8',
      Exp:'轉乘Flag(交易類別)',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_9:{
      Content:'mef03_9',
      Exp:'轉乘Flag(交易群組)',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_10:{
      Content:'mef03_10',
      Exp:'最近兩筆閘門交易紀錄(1)',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef03_11:{
      Content:'mef03_11',
      Exp:'交易序號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_12:{
      Content:'mef03_12',
      Exp:'交易時間',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:true,
      Rule:['LSB','Decimal','UnixTime']
    },
    mef03_13:{
      Content:'mef03_13',
      Exp:'交易類別',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_14:{
      Content:'mef03_14',
      Exp:'交易票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_15:{
      Content:'mef03_15',
      Exp:'交易後票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_16:{
      Content:'mef03_16',
      Exp:'交易系統編號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_17:{
      Content:'mef03_17',
      Exp:'交易地點/運輸業者',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_18:{
      Content:'mef03_18',
      Exp:'交易機器',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_19:{
      Content:'mef03_19',
      Exp:'最近兩筆閘門交易紀錄(2)',
      length:0,
      dataCoding:'undefined',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef03_20:{
      Content:'mef03_20',
      Exp:'交易序號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_21:{
      Content:'mef03_21',
      Exp:'交易時間',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:true,
      Rule:['LSB','Decimal','UnixTime']
    },
    mef03_22:{
      Content:'mef03_22',
      Exp:'交易類別',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_23:{
      Content:'mef03_23',
      Exp:'交易票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_24:{
      Content:'mef03_24',
      Exp:'交易後票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef03_25:{
      Content:'mef03_25',
      Exp:'交易系統編號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_26:{
      Content:'mef03_26',
      Exp:'交易地點/運輸業者',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef03_27:{
      Content:'mef03_27',
      Exp:'交易機器',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },

}

var mef08 = {
  mef08_0:{
    Content:'mef08_0',
    Exp:'里程客運進出站交易管理資料',
    length:0,
    dataCoding:'undefined',
    LSB:false,
    UnixTime:false,
    Rule:null
  },
  mef08_1:{
    Content:'mef08_1',
    Exp:'客運公司編號',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_2:{
    Content:'mef08_2',
    Exp:'最後一次上/下車碼',
    length:'2-4',
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Binary-0-1-LSB']
  },
  mef08_3:{
    Content:'mef08_3',
    Exp:'里程特種票類別代碼',
    length:'2-4',
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Binary-1-4-LSB']
  },
  mef08_4:{
    Content:'mef08_4',
    Exp:'保留',
    length:'2-4',
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Binary-4-8-LSB']
  },
  mef08_5:{
    Content:'mef08_5',
    Exp:'里程特種票原始可用次數/額度',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_6:{
    Content:'mef08_6',
    Exp:'里程特種票剩餘可用次數/額度',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_7:{
    Content:'mef08_7',
    Exp:'里程特種票有效日期',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_8:{
    Content:'mef08_8',
    Exp:'里程特種票有效天數',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_9:{
    Content:'mef08_9',
    Exp:'里程特種票有效起站',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_10:{
    Content:'mef08_10',
    Exp:'里程特種票有效迄站',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_11:{
    Content:'mef08_11',
    Exp:'當日累積里程交易日期',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_12:{
    Content:'mef08_12',
    Exp:'當日累積里程搭乘金額',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_13:{
    Content:'mef08_13',
    Exp:'最後一次搭乘路線編號',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_14:{
    Content:'mef08_14',
    Exp:'里程計費上車交易紀錄',
    length:0,
    dataCoding:'undefined',
    LSB:false,
    UnixTime:false,
    Rule:null
  },
  mef08_15:{
    Content:'mef08_15',
    Exp:'交易時間',
    length:8,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:true,
    Rule:['LSB','Decimal','UnixTime']
  },
  mef08_16:{
    Content:'mef08_16',
    Exp:'交易票值',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_17:{
    Content:'mef08_17',
    Exp:'交易後票值',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_18:{
    Content:'mef08_18',
    Exp:'交易類別',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_19:{
    Content:'mef08_19',
    Exp:'上車站別ID',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_20:{
    Content:'mef08_20',
    Exp:'交易序號',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_21:{
    Content:'mef08_21',
    Exp:'交易地點/運輸業者(DEV_ID)',
    length:8,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_22:{
    Content:'mef08_22',
    Exp:'行駛方向(往程:1返程:2循環:3)',
    length:'62-64',
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Binary-0-4-LSB']
  },
  mef08_23:{
    Content:'mef08_23',
    Exp:'保留',
    length:'62-64',
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Binary-4-8-LSB']
  },
  mef08_24:{
    Content:'mef08_24',
    Exp:'里程計費下車交易紀錄',
    length:0,
    dataCoding:'undefined',
    LSB:false,
    UnixTime:false,
    Rule:null
  },
  mef08_25:{
    Content:'mef08_25',
    Exp:'交易時間',
    length:8,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:true,
    Rule:['LSB','Decimal','UnixTime']
  },
  mef08_26:{
    Content:'mef08_26',
    Exp:'交易票值',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_27:{
    Content:'mef08_27',
    Exp:'交易後票值',
    length:4,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_28:{
    Content:'mef08_28',
    Exp:'交易類別',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_29:{
    Content:'mef08_29',
    Exp:'上車站別ID',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_30:{
    Content:'mef08_30',
    Exp:'交易序號',
    length:2,
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Decimal']
  },
  mef08_31:{
    Content:'mef08_31',
    Exp:'交易地點/運輸業者(DEV_ID)',
    length:8,
    dataCoding:'BIN',
    LSB:true,
    UnixTime:false,
    Rule:['LSB','Decimal']
  },
  mef08_32:{
    Content:'mef08_32',
    Exp:'行駛方向(往程:1返程:2循環:3)',
    length:'94-96',
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Binary-0-4-LSB']
  },
  mef08_33:{
    Content:'mef08_33',
    Exp:'保留',
    length:'94-96',
    dataCoding:'BIN',
    LSB:false,
    UnixTime:false,
    Rule:['Binary-4-8-LSB']
  }

}

var mef0b = {
    mef0b_0:{
      Content:'mef0b_0',
      Exp:'段次公車/客運特種票資料區',
      length:0,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef0b_1:{
      Content:'mef0b_1',
      Exp:'段次特種票識別單位',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_2:{
      Content:'mef0b_2',
      Exp:'段次特種票類別代碼',
      length:'2-4',
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Binary-0-3-LSB']
    },
    mef0b_3:{
      Content:'mef0b_3',
      Exp:'保留',
      length:'2-4',
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Binary-3-8-LSB']
    },
    mef0b_4:{
      Content:'mef0b_4',
      Exp:'段次特種票原始可用次數/額度',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_5:{
      Content:'mef0b_5',
      Exp:'段次特種票剩餘可用次數/額度',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_6:{
      Content:'mef0b_6',
      Exp:'段次特種票有效日期',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_7:{
      Content:'mef0b_7',
      Exp:'段次特種票有效天數',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_8:{
      Content:'mef0b_8',
      Exp:'段次特種票有效起站',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_9:{
      Content:'mef0b_9',
      Exp:'段次特種票有效迄站',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_10:{
      Content:'mef0b_10',
      Exp:'段次特種票保留',
      length:10,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_11:{
      Content:'mef0b_11',
      Exp:'段次公車/客運交易資料',
      length:0,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef0b_12:{
      Content:'mef0b_12',
      Exp:'路線編號',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef0b_13:{
      Content:'mef0b_13',
      Exp:'交易時間',
      length:8,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:true,
      Rule:['LSB','Decimal','UnixTime']
    },
    mef0b_14:{
      Content:'mef0b_14',
      Exp:'交易票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef0b_15:{
      Content:'mef0b_15',
      Exp:'交易後票值',
      length:4,
      dataCoding:'BIN',
      LSB:true,
      UnixTime:false,
      Rule:['LSB','Decimal']
    },
    mef0b_16:{
      Content:'mef0b_16',
      Exp:'交易類別',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_17:{
      Content:'mef0b_17',
      Exp:'交易地點/運輸業者(DEV_ID)',
      length:8,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_18:{
      Content:'mef0b_18',
      Exp:'段號',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_19:{
      Content:'mef0b_19',
      Exp:'保留',
      length:0,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:null
    },
    mef0b_20:{
      Content:'mef0b_20',
      Exp:'當日累積段次交易日期',
      length:4,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_21:{
      Content:'mef0b_21',
      Exp:'當日累積段次搭乘次數',
      length:2,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    },
    mef0b_22:{
      Content:'mef0b_22',
      Exp:'保留',
      length:26,
      dataCoding:'BIN',
      LSB:false,
      UnixTime:false,
      Rule:['Decimal']
    }

}
