#!/usr/bin/env python
# coding: utf-8

import httplib
import sys

if 3 > len(sys.argv):
  print 'usage: python %s host port' % sys.argv[0]
  quit()

print '...check target : host=%s, port=%d' % (sys.argv[1], int(sys.argv[2]))

conn = httplib.HTTPConnection(sys.argv[1], sys.argv[2])
conn.set_debuglevel(1)
print '...send "OPTIONS" method request to "/"...'
conn.request('OPTIONS', '/')
res = conn.getresponse()
print '...response status:%d (%s)' % (res.status, res.reason)
if 200 == res.status:
  hdrs = res.getheaders()
  allows = ''
  for hdr in hdrs:
    (h_k, h_v) = hdr
    if 'allow' == h_k:
      print '..."Allow" response header detected: %s' % h_v
      allows = h_v
      break
  if 'TRACE' in allows:
    print '...TRACE METHOD ENABLED'
  else:
    print '...TRACE METHOD DISABLED'
