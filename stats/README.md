Find average and median for columns and rows of text file containing numbers separated by tabs of the format (average rounded properly with .5 and above yielding the ceiling):

# 	1	3	8	8	8
#	8	0	6	5	5
#	8	5	5	4	4	
#	8	5	5	4	6

note: test file with odd rows and columns available (test_file.txt)
test file with even rows and columns available (test_file_even.txt)

pass in parameters with format in cmd line: ./stats {-rows | -columns} [filename]

{} brackets require one option
[] require one filename or standard input for numbers is initiated

example execution of program: ./stats -rows test_file.txt

example 2… execution of program (passing in -columns): ./stats -columns test_file_even.txt