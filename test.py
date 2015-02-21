import math, operator,sys
import hashlib

print(hashlib.md5(open(sys.argv[1]).read()).hexdigest())
