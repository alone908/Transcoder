function rule_tpl_definition(tpl) {
    var tplType = 'unknown';
    if(tpl.length === 0){ tplType = 'A' }
    else if(tpl.length === 2 && tpl[0] === 'HeadTitle' && tpl[1] === 'BodyTitle'){ tplType = 'B' }
    else if(tpl.length === 3 && tpl[0] === 'HeadTitle' && tpl[1] === 'BodyTitle' && tpl[2] === 'TailTitle'){ tplType = 'C' }
    else if(tpl.length === 4 && tpl[0] === 'HeadTitle' && tpl[1] === 'BodyTitle' && tpl[2] === 'JumpToRule' && tpl[3] === 'TailTitle'){ tplType = 'D' }
    return tplType;
}