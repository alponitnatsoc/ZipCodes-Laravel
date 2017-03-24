function reload(){
    var headerHeight = $("div.header").css('height');
    var footerHeight = $("div.footer").css('height');
    var contentHeight = $("div.content").css('height');
    headerHeight = parseInt(headerHeight.split('px')[0]);
    footerHeight = parseInt(footerHeight.split('px')[0]);
    contentHeight = parseInt(contentHeight.split('px')[0]);
    totalContentHeight = headerHeight + footerHeight + contentHeight;
    // $("div.title").css({'margin-top':(innerHeight - totalContentHeight)*.5});
}
