// ejemplo de como llenar los campos
// const dateString = '2024-05-14 12:30:45';
// const format = 'YYYY-MM-DD HH:mm:ss';
// Devuelve el timestamp correspondiente
function TbConvertStringToTimeStamp (dateString, format) {
    const dateParts = dateString.match(/(\d+)/g);
    let year, month, day, hours, minutes, seconds;

    format.split(/[^A-Za-z]/).forEach((part, index) => {
      switch(part) {
        case 'YYYY':
          year = dateParts[index];
          break;
        case 'MM':
          month = dateParts[index] - 1;
          break;
        case 'DD':
          day = dateParts[index];
          break;
        case 'HH':
          hours = dateParts[index];
          break;
        case 'mm':
          minutes = dateParts[index];
          break;
        case 'ss':
          seconds = dateParts[index];
          break;
      }
    });

    const date = new Date(year, month, day, hours || 0, minutes || 0, seconds || 0);
    return date.getTime();
}

// ejemplo de como llenar los campos
// const timestamp = 1715777445000;
// const format = 'YYYY-MM-DD HH:mm:ss';
// Devuelve '2024-05-14 12:30:45'
function TbConverTimeStampToString(timestamp, format) {
    const date = new Date(timestamp);

    const replacements = {
      'YYYY': date.getFullYear(),
      'MM': String(date.getMonth() + 1).padStart(2, '0'),
      'DD': String(date.getDate()).padStart(2, '0'),
      'HH': String(date.getHours()).padStart(2, '0'),
      'mm': String(date.getMinutes()).padStart(2, '0'),
      'ss': String(date.getSeconds()).padStart(2, '0')
    };

    return format.replace(/YYYY|MM|DD|HH|mm|ss/g, match => replacements[match]);
}


