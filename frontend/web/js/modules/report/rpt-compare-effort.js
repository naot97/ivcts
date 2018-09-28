function onClickShowMore(r, p, c) {
    var tr = $(r).parent().parent().nextUntil('.' + p, '.' + c);
    if (tr.is('.display-none')) {
      tr.removeClass('display-none');
    } else {
      if(p === 'GR' && c === 'PR') {
        tr = $(r).parent().parent().nextUntil('.' + p);
      }
      tr.addClass('display-none');
    }
};