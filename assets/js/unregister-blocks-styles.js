wp.domReady(function () {
  for (const block in disableBlocksStyles) {
    disableBlocksStyles[block].forEach(style => {
      wp.blocks.unregisterBlockStyle(block, style);
    });
  }
});
