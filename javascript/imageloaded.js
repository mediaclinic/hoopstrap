var $container = $('#container');
$container.imagesLoaded(function(){
  $container.masonry({
    itemSelector : '.thumbnail',
    columnWidth : 100
  });
});