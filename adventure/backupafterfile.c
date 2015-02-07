//
//  main.c
//  Program2
//
//  Created by Kenny Lu on 1/26/15.
//  Copyright (c) 2015 Kenny Lu. All rights reserved.
//

#include <stdio.h>

#include <sys/types.h>
#include <unistd.h>
#include <sys/stat.h>
#include <time.h>  /*time*/
#include <stdlib.h>   /*srand, rand */
#include <string.h>

int typeNumCheck (int startingNum, int endingNum, int range, int min);
void generateRan(int numbers[], int range, int min);

struct room
{
  int id;
  char *name;
  int connectNum;
  char type[15];
  int setType;
  char previous[20];
  int previousNum;
  char *connections[6];
};

int main(int argc, const char * argv[]) {
  
#define randnum(min, max) \
((rand()%(int)(((max) + 1)-(min)))+ (min))
  srand ((unsigned)time(NULL));
  rand()%100;
  randnum(1, 70);   //function makes numbers more random than rand().
  //source: http://stackoverflow.com/questions/822323/how-to-generate-a-random-number-in-c
  
  struct room record[7];
  int randUnique[10];
  int i;
  
  for(i=0; i<10; i++) {
    randUnique[i]=i;
  }
  
//  for (i=0; i<7; i++) {
//    printf("Ordered: %d\n", randUnique[i]);
//  }
  
  generateRan(randUnique, 9, 0);
  
//  for (i=0; i<7; i++) {
//    printf("Randomized %d: %d\n", i, randUnique[i]);
//  }
  
  
  char *name[]={"PLUGH", "PLOVER", "Bedquilt", "xyzzy", "Vortex", "Xel'Naga", "Cave of Wonders", "PALACE", "seattle", "MIGHTY BOWL" };
  char *randomName[]={" "," "," "," "," "," "," "," "," "," "};
  
  for (i=0; i<10; i++)  {
    randomName[randUnique[i]]=name[i];
  }
  
//  for (i=0; i<7; i++)
//  {
//    printf("%s", randomName[i]);
//  }
  
/* 2 random number will pick a room to be the starting and one to be
the ending room; the other rooms are mid rooms */
  
  //assign values to the rooms
  for (i=0; i<7; i++)
  {
    record[i].id=i;
    record[i].connectNum=randnum(3, 6);        //will generate a random number of connections from 3-6.
    record[i].name=randomName[i];
    
    if (i == 0)
    {
      record[i].setType=1;
      record[i].connectNum=randnum(3, 6);
      strcpy(record[i].type, "START_ROOM");
      printf("StartRoom is %s", record[i].name);
    }
    else if(i == 6)
    {
      record[i].setType=0;
      record[i].connectNum=randnum(4, 6);
      strcpy(record[i].type, "MID_ROOM");
    }
    else
    {
      record[i].setType=0;
      record[i].connectNum=randnum(4, 6);
      strcpy(record[i].type, "MID_ROOM");

    }
    
  }
  
  
  for (i=0; i<7; i++)
  {
    printf("Room %d is named %s\n", i, record[i].name);
  }
//  TEST FOR START_ROOM AND END_ROOM ASSIGNMENT
//  for (i=0; i<7; i++)
//  {
//    printf("Room %d is the %s\n", i, record[i].type);
//  }
  
  //assign random connections to start room
  
  
  int startingConn=record[0].connectNum;
  int nextRoom;
  int conn[7];
  
  
  for (i=0; i<startingConn; i++)
  {
    conn[i]=i+1;
  }
  
//  for (i=0; i<startingConn; i++)
//  {
//    printf("Before:%d\n", conn[i]);
//  }
  
  
  generateRan(conn, startingConn-1, 0);

  
//  for (i=0; i<startingConn; i++)
//  {
//    record[0].connections[i]=startMem;
//  }
  
  for (i=0; i<startingConn; i++)
  {
//    printf("After:%d\n", conn[i]);
//    printf("Rooms %d is still named %s\n", i, record[conn[i]].name);
    
    record[0].connections[i]=record[conn[i]].name;
  }
  
  
  for (i=0; i<startingConn; i++)
  {
    printf("CONNECTIONS ARRAY: %s\n", record[0].connections[i]);
  }

  int randN=randnum(1, 6);
  
  printf("Randnum = %d\n", randN);
  
  strcpy(record[randN].type, "END_ROOM");
  
  printf("END ROOM SHOULD BE %d %s\n", randN, record[randN].name);
  record[randN].setType=2;
  
  int endRoomNum=randN;
  char *endRoomName=record[endRoomNum].name;
  
  printf("END ROOM IS %s.", endRoomName);
  
  
  //generate next rooms
  int y=0;
  int currentRoom;
  int newRoom;
  int randomNums[6];
  
  
  for(i=0; i<6; i++)
  {
    randomNums[i]=i+1;
  }
  
  for(i=0; i<6; i++)
  {
    printf("Nums: %d\n",randomNums[i]);
  }
  
  for (i=1; i<7; i++)
  {
    
    int nextConn=record[i].connectNum;
    
    currentRoom=i;
    
  

    printf("Current Room is %s\n", record[i].name);
    
    generateRan(randomNums, 5, 1);
  
    
//    for (y=0; y<nextConn; y++)
//    {
//      record[conn[i]].connections[y]=startMem;
//    }

  


    for (y=0; y<6; y++)
    {
      printf ("Random Nums %d\n", randomNums[y]);
    }
    
    for (y=0; y<nextConn-1; y++)
    {
    
      newRoom=randomNums[y];
      
      if (currentRoom==newRoom)
      {
        newRoom=0;
      }
      
      
      record[i].connections[y]=record[newRoom].name;
      
      printf("Connection %d is %s\n", i, record[i].connections[y]);

    }
    
  
  }
  


  
//create folder
  int check;
  char folder[30];
  int pid = getpid();
  char filename[60];
  
  printf("My pid : %d\n", pid);
  
  sprintf(folder, "./luke.rooms.%03d/", pid);
  
  check = mkdir(folder, 0700);
  
  if(!check)
    printf("Directory created\n");
  else
  {
    printf("Unable to create directory\n");
  }
  
  printf("Saved to %s folder\n", folder);

  
//write to text file
  
  for (i=0; i<7; i++)
  {
    
    
    
  sprintf(filename, "./luke.rooms.%03d/room%d.txt", pid, i+1);
  
    FILE *f = fopen(filename, "w");
    if (f == NULL)
    {
      printf("Error opening file!\n");
      exit(1);
    }
  
  /* print some text */
    
    int connections=record[i].connectNum-1;
    int count;
    
    fprintf(f, "ROOM NAME: %s\n", record[i].name);
    
    for (y=0; y<connections; y++)
    {
      fprintf(f, "CONNECTION %d: %s\n", y+1, record[i].connections[y]);
      count++;
    }
    
    if (record[i].id==0)
    {
      fprintf(f, "CONNECTION %d: %s\n", count+1, record[i].connections[connections]);
    }
    
    fprintf(f, "ROOM TYPE: %s", record[i].type);
    
    
  }
  
    return 0;
}

int typeNumCheck (int startingNum, int endingNum, int range, int min)
{
  if (startingNum == endingNum)
  {
//    printf("Type numbers are the same.\n");
//    
//    printf("Starting room is %d.\n", startingNum);
//    printf("Ending room is %d.\n", endingNum);
    
    endingNum=typeNumCheck(startingNum, randnum(min, range), range, min);  /* recursively check to see if number
                                            is still the same or not*/
    return endingNum;
  }
  else
  {
  return endingNum;
  }
}

void generateRan(int numbers[], int range, int min){
  int i;
  
  for(i=0; i<range; i++) {
    int j =randnum(0, range);
    
    j=typeNumCheck(i, j, range, min);
    
    int temp = numbers[i];
    numbers[i] = numbers[j];
    numbers[j] = temp;
    
    
  }
}
