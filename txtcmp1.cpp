#include<stdio.h>

#include<iostream>
using namespace std;
int main(int argc,char **argv)
{  FILE *fp1, *fp2;
   int ch1, ch2;//cout<<argv[1]<<argv[2];
   fp1=fopen(argv[1],"r");
   fp2=fopen(argv[2],"r");
   if(fp1==NULL || fp2==NULL) cout<<"filenot";
      ch1 = getc(fp1);
      ch2 = getc(fp2);

      while ((ch1 != EOF) && (ch2 != EOF) && (ch1 == ch2)) {
         ch1 = getc(fp1);
         ch2 = getc(fp2);
      }
      if(ch1==ch2)
      return(1);
      else if(ch1!=ch2)
      return(0);
      
      fclose(fp1);
      fclose(fp2);
 
      
      
      }
