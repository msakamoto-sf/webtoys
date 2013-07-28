#!/usr/bin/env python
# coding: utf-8

import httplib
import base64
import sys

if 6 > len(sys.argv):
  print 'usage: python %s host port path basic-auth-user basic-auth-password' % sys.argv[0]
  print '    ex) python trace_to_basicauth.py localhost 80 /~msakamoto/webtoys/security/xst/basicauth.html user password'
  quit()

print '...check target : host=%s, port=%d, path=%s' % (sys.argv[1], int(sys.argv[2]), sys.argv[3])
basicauth_v = base64.b64encode(sys.argv[4] + ':' + sys.argv[5])
print '...basic auth : %s' % basicauth_v

conn = httplib.HTTPConnection(sys.argv[1], sys.argv[2])
conn.set_debuglevel(1)
print '...send "TRACE" method request to "%s"...' % sys.argv[3]
conn.request('TRACE', sys.argv[3], '', {'Authorization' : 'Basic ' + basicauth_v})
res = conn.getresponse()
print '...response status:%d (%s)' % (res.status, res.reason)
print '...response body:'
print res.read()
