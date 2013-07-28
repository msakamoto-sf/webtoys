var fsdemo = (function(){
var _is_supported = ('requestFileSystem' in window) || ('webkitRequestFileSystem' in window);
if (!_is_supported) {
  return { is_supported: false };
}
window.requestFileSystem = window.requestFileSystem || window.webkitRequestFileSystem;
var _public = {
  is_supported : true,
  keep_LocalFileSystem : ('LocalFileSystem' in window),
  use_webkit : ('webkitRequestFileSystem' in window),
  QUOTA : 5 * 1024 * 1024,
  PERSISTENT : (
    ('LocalFileSystem' in window)
    ? window.LocalFileSystem.PERSISTENT
    : (
      ('PERSISTENT' in window) 
      ? window.PERSISTENT 
      : undefined
      )
    ),
  TEMPORARY : (
    ('LocalFileSystem' in window)
    ? window.LocalFileSystem.TEMPORARY
    : (
      ('PERSISTENT' in window) 
      ? window.TEMPORARY
      : undefined
      )
    ),
  error_handler : function(e) {
    var msg = '';
    switch (e.code) {
      case FileError.QUOTA_EXCEEDED_ERR:
        msg = 'QUOTA_EXCEEDED_ERR';
        break;
      case FileError.NOT_FOUND_ERR:
        msg = 'NOT_FOUND_ERR';
        break;
      case FileError.SECURITY_ERR:
        msg = 'SECURITY_ERR';
        break;
      case FileError.INVALID_MODIFICATION_ERR:
        msg = 'INVALID_MODIFICATION_ERR';
        break;
      case FileError.INVALID_STATE_ERR:
        msg = 'INVALID_STATE_ERR';
        break;
      default:
        msg = 'Unknown Error';
        break;
    };
    console.log('Error: ' + msg);
  },
};

// {{{ requestPersistent ()

_public.requestPersistent = function(h)
{
  if ('webkitStorageInfo' in window) {
    window.webkitStorageInfo.requestQuota(
      _public.PERSISTENT, 
      _public.QUOTA,
      function(grantedBytes) {
        window.requestFileSystem(_public.PERSISTENT, grantedBytes, h, _public.errorHandler);
      },
      _public.errorHandler
      );
  } else {
    window.requestFileSystem(_public.PERSISTENT, _public.QUOTA, h, _public.errorHandler);
  }
}

// }}}
// {{{ requestTemporary()

_public.requestTemporary = function(h)
{
  window.requestFileSystem(_public.TEMPORARY, _public.QUOTA, h, _public.errorHandler);
}

// }}}
// {{{ saveToPersistent()

_public.saveToPersistent = function(fname, data)
{
  _public.requestPersistent(
    function(fs){
      fs.root.getFile(fname, {create: true}, 
        function(fileEntry) {
          _public.last_file_entry_fullpath =fileEntry.fullPath;
          fileEntry.createWriter(
            function(writer) {
              writer.onwrite = function(evt) { alert("success"); }
              var bb;
              if ('WebKitBlobBuilder' in window) {
                bb = new WebKitBlobBuilder();
              } else {
                bb = new BlobBuilder();
              }
              bb.append(data);
              writer.write(bb.getBlob('text/plain'));
            },
            _public.errorHandler
          );
        }, 
        _public.errorHandler
      );
    }
  );
}

// }}}
// {{{ loadFromPersistent()

_public.loadFromPersistent = function(fname, loadcallback)
{
  _public.requestPersistent(
    function(fs){
      fs.root.getFile(fname, {}, 
        function(fileEntry) {
          fileEntry.file(function(file) {
            var reader = new FileReader();
            reader.onloadend = function(e) {
              loadcallback(this.result);
            };
            reader.readAsText(file);
          }, _public.errorHandler);
        }, _public.errorHandler
      );
    }
  );
}

// }}}
// {{{ saveToTemporary()

_public.saveToTemporary = function(fname, data)
{
  _public.requestTemporary(
    function(fs){
      fs.root.getFile(fname, {create: true}, 
        function(fileEntry) {
          _public.last_file_entry_fullpath =fileEntry.fullPath;
          fileEntry.createWriter(
            function(writer) {
              writer.onwrite = function(evt) { alert("success"); }
              var bb;
              if ('WebKitBlobBuilder' in window) {
                bb = new WebKitBlobBuilder();
              } else {
                bb = new BlobBuilder();
              }
              bb.append(data);
              writer.write(bb.getBlob('text/plain'));
            },
            _public.errorHandler
          );
        }, 
        _public.errorHandler
      );
    }
  );
}

// }}}
// {{{ loadFromTemporary()

_public.loadFromTemporary = function(fname, loadcallback)
{
  _public.requestTemporary(
    function(fs){
      fs.root.getFile(fname, {}, 
        function(fileEntry) {
          fileEntry.file(function(file) {
            var reader = new FileReader();
            reader.onloadend = function(e) {
              loadcallback(this.result);
            };
            reader.readAsText(file);
          }, _public.errorHandler);
        }, _public.errorHandler
      );
    }
  );
}

// }}}

return _public;
})();
