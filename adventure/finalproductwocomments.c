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

struct afterRead
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

void startGame (int prevRoom, int roomID, struct afterRead postRead[7], int steps, char stepsArray[50][20], int revisit);
int typeNumCheck (int startingNum, int endingNum, int range, int min);
void generateRan(int numbers[], int range, int min);
void end(int steps, char stepsArray[50][20]);

int main(int argc, const char * argv[]) {
  
#define randnum(min, max) \
((rand()%(int)(((max) + 1)-(min)))+ (min))
	srand ((unsigned)time(NULL));
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
  
  
	char *name[]={"PLUGH", "PLOVER", "Bedquilt", "xyzzy", "Vortex", "Xel'Naga", "Cave-of-Wonders", "PALACE", "seattle", "MIGHTY-BOWL" };
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
//			printf("StartRoom is %s", record[i].name);
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
	
  
//	for (i=0; i<7; i++)
//	{
//		printf("Room %d is named %s\n", i, record[i].name);
//	}
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
	
  
//	for (i=0; i<startingConn; i++)
//	{
//		printf("CONNECTIONS 0: %s\n", record[0].connections[i]);
//	}

	int randN=randnum(1, 6);

//	printf("Randnum = %d\n", randN);

	strcpy(record[randN].type, "END_ROOM");

	//printf("END ROOM SHOULD BE %d %s\n", randN, record[randN].name);
	record[randN].setType=2;

	int endRoomNum=randN;
	char *endRoomName=record[endRoomNum].name;

//	printf("END ROOM IS %s.\n", endRoomName);

  
	//generate next rooms
	int y=0;
	int currentRoom;
	int newRoom;
	int randomNums[6];


	for(i=0; i<6; i++)
	{
		randomNums[i]=i+1;
	}

//	for(i=0; i<6; i++)
//	{
//		printf("Nums: %d\n",randomNums[i]);
//	}

	for (i=1; i<7; i++)
	{

		int nextConn=record[i].connectNum;

		currentRoom=i;



//		printf("Current Room is %s\n", record[i].name);

		generateRan(randomNums, 5, 1);


	//    for (y=0; y<nextConn; y++)
	//    {
	//      record[conn[i]].connections[y]=startMem;
	//    }




//	for (y=0; y<6; y++)
//	{
//		printf ("Random Nums %d\n", randomNums[y]);
//	}
		
	for (y=0; y<nextConn-1; y++)
	{

		newRoom=randomNums[y];

	if (currentRoom==newRoom)
	{
		newRoom=0;
	}


	record[i].connections[y]=record[newRoom].name;

//	printf("Connection %d is %s\n", i, record[i].connections[y]);

	}


}
	


  
//create folder
  int check;
  char folder[30];
  int pid = getpid();
  char filename[60];
  char filename2[60];
  
  //printf("My pid : %d\n", pid);
  
  sprintf(folder, "./luke.rooms.%03d/", pid);
  
  check = mkdir(folder, 0700);
  
//  if(!check)
//    printf("Directory created\n");
//  else
//  {
//    printf("Unable to create directory\n");
//  }
	
//  printf("Saved to %s folder\n", folder);

  
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
  

    
    int connections=record[i].connectNum-1;
    int count=0;
    
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
    
    fprintf(f, "ROOM TYPE: %s\n", record[i].type);
    
    fclose(f);
  }
  
  
  //read from file and store values in variables
  
  struct afterRead textRecord[7];
  char string[7][100];
  char *token[]={" ", " " ," "," "," "," " ," "};
  const char **result = NULL;
	
	//read room name
  for(i=0; i<7; i++)
  {
  result=realloc(result, sizeof(char*) * i+1);
    
  sprintf(filename2, "./luke.rooms.%03d/room%d.txt", pid, i+1);
    
  FILE *fp = fopen(filename2, "r");
  
  if (fp == NULL)
  {
    printf("Error opening file!\n");
    exit(1);
  }
  
  
    fgets(string[i], 100, fp);
    
    token[i]=strtok(string[i], ":");
    
    token[i]=strtok(NULL, " \n");
    
    textRecord[i].name=token[i];
	textRecord[i].id=i;
  
  }
	
	
	//read room's connections
	
	char string2[7][7][100];
	
	for (i=0; i<7; i++)
	{
		int connectNum=record[i].connectNum;
		char *token2[connectNum][7];
		int count=0;
		int clock=0;
		int stringCount=0;
		int accum=0;
		
		sprintf(filename2, "./luke.rooms.%03d/room%d.txt", pid, i+1);
		
		FILE *fp = fopen(filename2, "r");
		
		if (fp == NULL)
		{
		  printf("Error opening file!\n");
		  exit(1);
		}

		
		while (fgets(string2[stringCount][i], 100, fp) != NULL)
		{
			
			
			if(i==0 && count>=1 && count<connectNum+1)
			{
				
				token2[clock][i]=strtok(string2[stringCount][i], ":");
				token2[clock][i]=strtok(NULL, " \n");
				
				//printf("Room %d: %s\n", i, token2[clock][i]);
				textRecord[i].connections[accum]=token2[clock][i];
				
				clock++;
				accum++;
				
				if (count==connectNum)
				{
					clock=0;
					accum=0;
				}
				

				
			}
			
			else if(i!=0 && count>=1 && count<connectNum)
			{
				
				token2[clock][i]=strtok(string2[stringCount][i], ":");
				token2[clock][i]=strtok(NULL, " \n");
				
				//printf("Room %d: %s\n", i, token2[clock][i]);
				textRecord[i].connections[accum]=token2[clock][i];
				
				clock++;
				accum++;
				
				if (count==connectNum-1)
				{
					clock=0;
					accum=0;
				}
				
			}

			
			stringCount++;
			count++;
		}
	}


	
//	for (i=0; i<7; i++)
//	{
//		int soos=record[i].connectNum;
//		for (y=0; y<soos-1; y++)
//		{
//		printf("Room %d CONNECTION: %s\n", i, textRecord[i].connections[y]);
//		}
//	}
	
	
	//read in room type (last line)
	
	char string3[7][100];
	int stringCount2=0;
	int count=0;
	char *token3[]={" "," "," "," "," "," "," "};
	
	for (i=0; i<7; i++)
	{
		int connectNum=record[i].connectNum;
		sprintf(filename2, "./luke.rooms.%03d/room%d.txt", pid, i+1);
		
		FILE *fp = fopen(filename2, "r");
		
		if (fp == NULL)
		{
			printf("Error opening file!\n");
			exit(1);
		}
		
		while (fgets(string3[stringCount2], 100, fp) != NULL)
		{
			if (count>connectNum)
			{
				token3[i]=strtok(string3[stringCount2], ":");
				token3[i]=strtok(NULL, " \n");
				
				//printf("Room %d: %s\n", i, token3[i]);
				
				stringCount2++;
				
				count=0;
			}
			count++;
			
			strcpy(textRecord[i].type, token3[i]);
			textRecord[i].connectNum=record[i].connectNum;
			
			if (strcmp(token3[i], "START_ROOM")==0)
			{
				textRecord[i].setType=1;
			}
			else if (strcmp(token3[i], "END_ROOM")==0)
			{
				textRecord[i].setType=2;
			}
			else
			{
				textRecord[i].setType=0;
			}
		}
		
	}
		
//	for (i=0; i<7; i++)
//	{
//		printf("textrec: %s... numType: %d\n", textRecord[i].type, textRecord[i].setType);
//	}
	
	
	//parsing complete: gameplay for user starts!
	
	int roomID=0;
	int prev=0;
	int steps=0;
	char stepsArray[50][20];
	
	startGame(prev, roomID, textRecord, steps, stepsArray, 0);
	
	
	

	
    return 0;
}
void startGame (int prevRoom, int roomID, struct afterRead postRead[7], int steps, char stepsArray[50][20], int revisit)
{
	
	if(roomID==0)
	{
	int nextRoom=0;
	int y=0;
	int i=0;
	int connects=postRead[roomID].connectNum;
	char userInput[100];
		
	
	//printf("Connections: %d\n", connects);
	
		
	
	printf("CURRENT LOCATION: %s\n", postRead[roomID].name);
	printf("POSSIBLE CONNECTIONS: ");
	for (i=0; i<connects; i++)
	{
		printf("%s", postRead[roomID].connections[i]);
		
		if(i != connects-1)
		{
			printf(", ");
		}
		else
		{
			printf(".\n");
		}
	}
	
	printf("WHERE TO? >");
	
	scanf("%s", userInput);
		
	printf("\n");
	
	//printf("USER INPUT %s\n", userInput);
	
	for (i=0; i<connects; i++)
	{
		if(strcmp(userInput, postRead[roomID].connections[i])==0)
		{
			for (y=0; y<7; y++)
			{
				if(strcmp(postRead[roomID].connections[i], postRead[y].name)==0)
				{
					nextRoom=postRead[y].id;
					break;
				}
			}
			
			prevRoom=postRead[roomID].id;
			

			if (revisit==1)
			{
				strcpy(stepsArray[steps], postRead[roomID].name);
				steps++;
			}
			

			startGame(prevRoom, nextRoom, postRead, steps, stepsArray, 1);
		}

	}
	if (revisit==0)
	{
	printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
	startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 0);
	}
		else if (revisit==1)
		{
			printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
			startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 1);
		}
	}
	else
	{
		int nextRoom=0;
		int i=0;
		int y=0;
		int connects=postRead[roomID].connectNum;
		char userInput[100];
		int prevExists=0;
		
		
//		printf("Connections: %d\n", connects);
		
//		printf("Previous Room: %s\n", postRead[prevRoom].name);
		
//		postRead[roomID].connections[connects-1]=postRead[prevRoom].name;
		
//		printf("Last Connect: %s\n", postRead[roomID].connections[connects-1]);
		
		if (postRead[roomID].setType==2)
		{
			strcpy(stepsArray[steps], postRead[roomID].name);
			steps++;
			end(steps, stepsArray);
		}
		
		printf("CURRENT LOCATION: %s\n", postRead[roomID].name);
		printf("POSSIBLE CONNECTIONS: ");
		
		for (i=0; i<connects-1; i++)
		{
//			printf("Current Room Connections: %s\n", postRead[roomID].connections[i]);
			
			if (strcmp(postRead[prevRoom].name, postRead[roomID].connections[i])==0)
			{
				prevExists=1;
			}

		}
		
//		printf("Prev Exists %d\n", prevExists);
		
		if (prevExists==1)
		{
			for (i=0; i<connects-1; i++)
			{
				printf("%s", postRead[roomID].connections[i]);
				
				if(i != connects-2)
				{
					printf(", ");
				}
				else
				{
					printf(".\n");
				}
			}
			
			printf("WHERE TO? >");
			
			scanf("%s", userInput);
			
			printf("\n");
			
			//printf("USER INPUT %s\n", userInput);
			
			for (i=0; i<connects-1; i++)
			{
				if(strcmp(postRead[roomID].connections[i], userInput)==0)
				{
					for (y=0; y<7; y++)
					{
						if(strcmp(postRead[roomID].connections[i], postRead[y].name)==0)
						{
							nextRoom=postRead[y].id;
							break;
						}
					}
					
					prevRoom=postRead[roomID].id;
					strcpy(stepsArray[steps], postRead[roomID].name);
					
					steps++;
					startGame(prevRoom, nextRoom, postRead, steps, stepsArray, 1);
				}
				
			}
			printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
			startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 1);

		}
		
		else
		{
		
		postRead[roomID].connections[connects-1]=postRead[prevRoom].name;
			
		for (i=0; i<connects; i++)
		{
			printf("%s", postRead[roomID].connections[i]);
			
			if(i != connects-1)
			{
				printf(", ");
			}
			else
			{
				printf(".\n");
			}
		}
		
		printf("WHERE TO? >");
		
		scanf("%s", userInput);
		
		printf("\n");
		
		//printf("USER INPUT %s\n", userInput);
		
		for (i=0; i<connects; i++)
		{
			if(strcmp(postRead[roomID].connections[i], userInput)==0)
			{
				for (y=0; y<7; y++)
				{
					if(strcmp(postRead[roomID].connections[i], postRead[y].name)==0)
					{
						nextRoom=postRead[y].id;
						break;
					}
				}
				
				prevRoom=postRead[roomID].id;
				strcpy(stepsArray[steps], postRead[roomID].name);
				steps++;
				startGame(prevRoom, nextRoom, postRead, steps, stepsArray, 1);
			}
			
		}
			printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
			startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 1);
		}
		
		
	}
	
	
}

void end(int steps, char stepsArray[50][20])
{
	int i=0;
	printf("YOU HAVE FOUND THE END ROOM. CONGRATULATIONS!\n");
	printf("YOU TOOK ");
	printf("%d", steps);
	printf(" STEPS. YOUR PATH TO VICTORY WAS:\n");
	for (i=0; i<steps; i++)
	{
		printf("%s\n", stepsArray[i]);
	}
	
	exit(0);
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
