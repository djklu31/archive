//
//  ViewController.swift
//  calculator
//
//  Created by Kenny Lu on 3/24/15.
//  Copyright (c) 2015 Kenny Lu. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

	@IBOutlet weak var calcField: UITextField!
	
	var count = 0
	var operat = String()
	
	var firstValue = String()
	var nextValues = String()
	
	var firstNum = 0
	var nextNums = 0
	
	var numSet = false
	
	override func viewDidLoad() {
		super.viewDidLoad()
		
		calcField.text = String(0)
	}
	
	@IBAction func numbers(sender: UIButton) {
		
		if (numSet == false) {
			firstValue = sender.titleLabel!.text!
			
			if(firstValue != "+" && firstValue != "-" && firstValue != "x" && firstValue != "/") {
				calcField.text = firstValue
				firstNum = firstValue.toInt()!
				
				numSet = true
			}
			else
			{
				return;
			}
		}
		else {
			nextValues = sender.titleLabel!.text!
			
			switch nextValues {
				case "+":
					operat = nextValues
				case "-":
					operat = nextValues
				case "x":
					operat = nextValues
				case "/":
					operat = nextValues
			default:
				calcField.text = nextValues
				
				nextNums = nextValues.toInt()!
				
			}
			
		}
		
		
	}
	
	@IBAction func clear(sender: AnyObject) {
		calcField.text = String(0);
		numSet = false
	}
	
	@IBAction func equals(sender: AnyObject) {
		count = calculate(firstNum, nextNums: nextNums, operat: operat)
		firstNum = count
		calcField.text = String(count)
	}
	
	func calculate(firstNum: Int, nextNums: Int, operat: String) -> Int
	{
		switch operat {
			case "+":
				count = firstNum+nextNums
				return count
			case "-":
				count = firstNum-nextNums
				return count
			case "x":
				count = firstNum*nextNums
				return count
			case "/":
				count = firstNum/nextNums
				return count
		default:
			println("No operator")
			return count
		}
	}

	
}

