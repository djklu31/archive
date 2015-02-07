/*
 Kenny Lu
 01/26/2015
 CS344
 Program 2
 Adventure Game
*/

#include <stdio.h>

#include <sys/types.h>	//for folder creation
#include <unistd.h>
#include <sys/stat.h>
#include <time.h>  /*time*/
#include <stdlib.h>   /*srand, rand */
#include <string.h>

//this struct will hold all of the important stats to
//be read to files
struct room
{
	int id;		//distinguishes rooms numerically
	char *name;
	int connectNum;	//how many number of connections per room
	char type[15];	//what type of room: END_ROOM, START_ROOM, MID_ROOM
	int setType;	//distinguishes type of room numerically 0=mid, 1=start, 2=end
	char previous[20];
	int previousNum;
	char *connections[6];	//array that stores the names of all connected rooms
};

//this is the struct that will hold the memory required
//for game play after files have been written and read
//the parameters are the same as above
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
//function prototypes... descriptions below
void startGame (int prevRoom, int roomID, struct afterRead postRead[7], int steps, char stepsArray[50][20], int revisit);
int typeNumCheck (int startingNum, int endingNum, int range, int min);
void generateRan(int numbers[], int range, int min);
void end(int steps, char stepsArray[50][20]);

int main(int argc, const char * argv[]) {

//randnum will create a random number from range min to max
//i find that this function is more reliable than srand/rand
#define randnum(min, max) \
((rand()%(int)(((max) + 1)-(min)))+ (min))
	srand ((unsigned)time(NULL));
	//source: http://stackoverflow.com/questions/822323/how-to-generate-a-random-number-in-c
  
	struct room record[7];	//initialize array of structs (1 per room)
	int randUnique[10];		//will generate 10 unique numbers for names.
	int i;
	
	//initialize numbers between 0 and 9
	for(i=0; i<10; i++) {
		randUnique[i]=i;
	}
	
	generateRan(randUnique, 9, 0);		//function that randomizes numbers
	//declare 10 names
	char *name[]={"PLUGH", "PLOVER", "Bedquilt", "xyzzy", "Vortex", "Xel'Naga", "Cave-of-Wonders", "PALACE", "seattle", "MIGHTY-BOWL" };
	char *randomName[]={" "," "," "," "," "," "," "," "," "," "};
	
	
	for (i=0; i<10; i++)  {	//randomized indexes are set to names
		randomName[randUnique[i]]=name[i];
	}
	
/* 2 random number will pick a room to be the starting and one to be
the ending room; the other rooms are mid rooms */
  
  //1) assign values to the rooms
	//set values to array of struct room
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
		}
		else if(i == 6)
		{
			record[i].setType=0;
			record[i].connectNum=randnum(4, 6);	//generate random number between 4 and 6
			//because we need room for a previous room upon gameplay.
			strcpy(record[i].type, "MID_ROOM");
		}
		else
		{
			record[i].setType=0;
			record[i].connectNum=randnum(4, 6);
			strcpy(record[i].type, "MID_ROOM");

		}
	}
  
  //2)assign random connections to start room
  
  
	int startingConn=record[0].connectNum;	//how many connections in the starting room
	int nextRoom;
	int conn[7];

  
	for (i=0; i<startingConn; i++)
	{
		conn[i]=i+1;
	}
	generateRan(conn, startingConn-1, 0);

	for (i=0; i<startingConn; i++)
	{
		record[0].connections[i]=record[conn[i]].name;	//set connections for starting room
	}
	//setup last room
	int randN=randnum(1, 6);	//random number between 1 and 6
	
	strcpy(record[randN].type, "END_ROOM");		//last room is assigned a random number for the index

	record[randN].setType=2;		//set type of last room

	int endRoomNum=randN;
	char *endRoomName=record[endRoomNum].name;

  
//3) generate next rooms
	int y=0;
	int currentRoom;
	int newRoom;
	int randomNums[6];


	for(i=0; i<6; i++)
	{
		randomNums[i]=i+1;	//list out number from 1-6 to be randomized later
	}

	for (i=1; i<7; i++)
	{

		int nextConn=record[i].connectNum;		//number of connections for the rooms besides the starting one

		currentRoom=i;

		generateRan(randomNums, 5, 1);	//generate random numbers
		
	//4)save possible connections of rooms
		
	for (y=0; y<nextConn-1; y++)
	{

		newRoom=randomNums[y];

		if (currentRoom==newRoom)		//make sure current room is not the new room
		{
			newRoom=0;
		}

		record[i].connections[y]=record[newRoom].name;	//save connection

		}
	}
	
//5) create folder
  int check;
  char folder[30];
  int pid = getpid();		//save pid in varible
  char filename[60];
  char filename2[60];
  
  //printf("My pid : %d\n", pid);
  
  sprintf(folder, "./luke.rooms.%03d/", pid);		//save parsed directory to variable folder
	
  check = mkdir(folder, 0700);		//set permissions for folder and create
	
//6) write to text file
  
	for (i=0; i<7; i++)
	{
		sprintf(filename, "./luke.rooms.%03d/room%d.txt", pid, i+1);	//write all files to this folder

		FILE *f = fopen(filename, "w");
		if (f == NULL)
		{
			printf("Error opening file!\n");
			exit(1);
		}
  
    
		int connections=record[i].connectNum-1;
		int count=0;
		
		fprintf(f, "ROOM NAME: %s\n", record[i].name);		//write to file

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
  
  
  //7) read from file and store values in variables
  
	struct afterRead textRecord[7];		//initialize array of structs to be read into program from text files
	char string[7][100];
	char *token[]={" ", " " ," "," "," "," " ," "};		//initialie token array with blank values
	const char **result = NULL;		//create an array to store result of room name in next section
	
	//read room name
	for(i=0; i<7; i++)
	{
		result=realloc(result, sizeof(char*) * i+1);		//reallocate memory to cater to room name

		sprintf(filename2, "./luke.rooms.%03d/room%d.txt", pid, i+1);	//where file will be located

		FILE *fp = fopen(filename2, "r");

		if (fp == NULL)
		{
				printf("Error opening file!\n");
				exit(1);
		}
	
  
		fgets(string[i], 100, fp);

		token[i]=strtok(string[i], ":");

		token[i]=strtok(NULL, " \n");	//parse just the room name with string token

		textRecord[i].name=token[i];	//save room name into post read struct
		textRecord[i].id=i;				//save id into post read struct
  
	}
	
	
	//8) read room's connections
	
	char string2[7][7][100];	//create a multidimensional array that will hold up to 100 chars
	//important for saving information in loop
	
	for (i=0; i<7; i++)
	{
		int connectNum=record[i].connectNum;
		char *token2[connectNum][7];	//new token for read in
		int count=0;	//accumulator variable
		int clock=0;	//accumulator variable
		int stringCount=0;
		int accum=0;	//accumulator variable
		
		sprintf(filename2, "./luke.rooms.%03d/room%d.txt", pid, i+1);
		
		FILE *fp = fopen(filename2, "r");
		
		if (fp == NULL)
		{
			printf("Error opening file!\n");
			exit(1);
		}

		
		while (fgets(string2[stringCount][i], 100, fp) != NULL)	//save read in text to string2 array
		{
			
			
			if(i==0 && count>=1 && count<connectNum+1)	//for starting room
			{
				
				token2[clock][i]=strtok(string2[stringCount][i], ":");
				token2[clock][i]=strtok(NULL, " \n");	//use string token to extract connections
				
				textRecord[i].connections[accum]=token2[clock][i];
				
				clock++;
				accum++;
				
				if (count==connectNum)
				{
					clock=0;
					accum=0;
				}
				

				
			}
			
			else if(i!=0 && count>=1 && count<connectNum)	//for rooms other than starting room
			{
				
				token2[clock][i]=strtok(string2[stringCount][i], ":");
				token2[clock][i]=strtok(NULL, " \n");	//parse text files for connections
				
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
	
//9) read in room type (last line)
	
	char string3[7][100];		//create an array that will store the room type
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
			
			strcpy(textRecord[i].type, token3[i]);	//copy room type to room type in post struct
			textRecord[i].connectNum=record[i].connectNum;
			
			//set type values accordingly
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
	
	//10) parsing complete: gameplay for user starts!
	//prep parameters for passing into function
	int roomID=0;	//keep track of current room
	int prev=0;		//keep track of previous room
	int steps=0;	//how many steps have been taken
	char stepsArray[50][20];	//keep track of steps taken by name
	
	//start game
	startGame(prev, roomID, textRecord, steps, stepsArray, 0);
	
    return 0;
}

/*Games will start with this function. prevRoom keeps track of previous rooms, roomID keeps track of current room,
 the struct postRead is the struct passed in after reading text files, steps is how many steps are taken,
 stepsArray keeps track of rooms visited, revisit keeps track of startingRoom to determine if its been visited before.
*/
void startGame (int prevRoom, int roomID, struct afterRead postRead[7], int steps, char stepsArray[50][20], int revisit)
{
	
	if(roomID==0)	//if current room is starting room
	{
		int nextRoom=0;
		int y=0;
		int i=0;
		int connects=postRead[roomID].connectNum;
		char userInput[100];	//user input
		
	
	
		printf("CURRENT LOCATION: %s\n", postRead[roomID].name);
		printf("POSSIBLE CONNECTIONS: ");
		for (i=0; i<connects; i++)
		{
			printf("%s", postRead[roomID].connections[i]);	//print possible connections
			
			if(i != connects-1)
			{
				printf(", ");	//insert commas
			}
			else
			{
				printf(".\n");	//insert ending period
			}
		}
	
		printf("WHERE TO? >");
		
		scanf("%s", userInput);
			
		printf("\n");
		
		//printf("USER INPUT %s\n", userInput);
		
		for (i=0; i<connects; i++)
		{
			if(strcmp(userInput, postRead[roomID].connections[i])==0)	//see if "strings" are the same
			{
				for (y=0; y<7; y++)
				{
					if(strcmp(postRead[roomID].connections[i], postRead[y].name)==0)	//see if "strings" are the same
					{
						nextRoom=postRead[y].id;
						break;
					}
				}
				
				prevRoom=postRead[roomID].id;
				

		if (revisit==1)	//if started room is a revisit, record steps taken and path taken
		{
			strcpy(stepsArray[steps], postRead[roomID].name);
			steps++;
		}
				startGame(prevRoom, nextRoom, postRead, steps, stepsArray, 1);
		}
	}
		
	if (revisit==0)	//if starting room hasn't been visited before, the step will not be tracked
	{
		printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
		startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 0);	//if error, replay start function with current room
	}
	else if (revisit==1)
	{
		printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
		startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 1);	//sets the revisted flag to 1 which represents visited
	}
		
	}
	else
	{
		//same parameter agendas as the first part of the if statement... only catered for non start_rooms.
		int nextRoom=0;
		int i=0;
		int y=0;
		int connects=postRead[roomID].connectNum;
		char userInput[100];
		int prevExists=0;
		
		if (postRead[roomID].setType==2)	//if setType is 2, end rooms has been reached, end game.
		{
			strcpy(stepsArray[steps], postRead[roomID].name);
			steps++;
			end(steps, stepsArray);
		}
		
		printf("CURRENT LOCATION: %s\n", postRead[roomID].name);
		printf("POSSIBLE CONNECTIONS: ");
		
		for (i=0; i<connects-1; i++)
		{
			
			if (strcmp(postRead[prevRoom].name, postRead[roomID].connections[i])==0)
			{
				prevExists=1;
			}

		}
		
		if (prevExists==1)		//if previous room exists in the possible connections, don't add previous room
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
			
			for (i=0; i<connects-1; i++)
			{	//check to see if possible connections matches the userInput
				if(strcmp(postRead[roomID].connections[i], userInput)==0)
				{
					for (y=0; y<7; y++)
					{	//set up the next room to be passed to start game function
						if(strcmp(postRead[roomID].connections[i], postRead[y].name)==0)
						{
							nextRoom=postRead[y].id;
							break;
						}
					}
					
					prevRoom=postRead[roomID].id;	//set current room as previous room to be pass in
					strcpy(stepsArray[steps], postRead[roomID].name);	//add current room to steps taken (stepsArray)
					
					steps++;
					startGame(prevRoom, nextRoom, postRead, steps, stepsArray, 1);
				}
				
			}
			printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
			startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 1);

		}
		
		else		//if previous room doesn't exist in possible connections, add it to the last array index.
		{
		
			postRead[roomID].connections[connects-1]=postRead[prevRoom].name;	//previous room is now the last array element
			
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
		{	//check to see if possible connections matches the userInput
			if(strcmp(postRead[roomID].connections[i], userInput)==0)
			{
				for (y=0; y<7; y++)
				{	//set up the next room to be passed to start game function
					if(strcmp(postRead[roomID].connections[i], postRead[y].name)==0)
					{
						nextRoom=postRead[y].id;
						break;
					}
				}
				
				prevRoom=postRead[roomID].id;	//set previous room
				strcpy(stepsArray[steps], postRead[roomID].name); //add current room to steps array
				steps++;
				startGame(prevRoom, nextRoom, postRead, steps, stepsArray, 1);
			}
			
		}
			printf("HUH? I DON’T UNDERSTAND THAT ROOM. TRY AGAIN.\n\n");
			startGame(prevRoom, postRead[roomID].id, postRead, steps, stepsArray, 1);
		}
		
		
	}
	
	
}

//end game... steps is how many steps have been taken (int) and stepsArray keeps track of the names of rooms visited
void end(int steps, char stepsArray[50][20])
{
	int i=0;
	printf("YOU HAVE FOUND THE END ROOM. CONGRATULATIONS!\n");
	printf("YOU TOOK ");
	printf("%d", steps);
	printf(" STEPS. YOUR PATH TO VICTORY WAS:\n");
	for (i=0; i<steps; i++)
	{
		printf("%s\n", stepsArray[i]);	//print steps taken
	}
	
	exit(0);
}

//checks to see if two numbers are the same, if they are, keep generating a random numbers until the two are unique
int typeNumCheck (int startingNum, int endingNum, int range, int min)
{
	if (startingNum == endingNum)
	{
    
		endingNum=typeNumCheck(startingNum, randnum(min, range), range, min);  /* recursively check to see if number
                                            is still the same or not*/
		return endingNum;
	}
	else
	{
		return endingNum;
	}
}
//swaps an array of numbers passed in.  numbers[] represents the array passed in,
//min is the minimum index to be used for swapping; range represents the max index to be used for swapping.
void generateRan(int numbers[], int range, int min){
	int i;
  
	for(i=0; i<range; i++) {
		int j =randnum(0, range);
		
		//make sure the i index and j are different numbers
		j=typeNumCheck(i, j, range, min);
		
		//swap numbers
		int temp = numbers[i];
		numbers[i] = numbers[j];
		numbers[j] = temp;
    
    
	}
}
