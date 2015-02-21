import math, operator , json
import hashlib
from PIL import Image

def compare(file1, file2):
    image1 = Image.open(file1)
    image2 = Image.open(file2)
    h1 = image1.histogram()
    #print (hashlib.md5(open(file1).read()).hexdigest())
    h2 = image2.histogram()
    rms = math.sqrt(reduce(operator.add,
                           map(lambda a,b: (a-b)**2, h1, h2))/len(h1))
    return rms

if __name__=='__main__':
    import sys
    f="0"

    try:

      data= json.loads(sys.argv[3])

    except:
      print('Exception')
    for i in range (0,int(sys.argv[1])-1):

       if compare(sys.argv[2],data[i]) !=0:
         continue
       else:
         f="1"
         print(data[i])
         break
    print(f)

