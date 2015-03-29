//
//  ViewController.swift
//  calculator
//
//  Created by Kenny Lu on 3/24/15.
//  Copyright (c) 2015 Kenny Lu. All rights reserved.
//

import UIKit

class ViewController: UIViewController {
	
	var firstNumSet = false
	var nextValue = String()
	var resultSoFar = 0
	var previousValue = String()
	var operate : String?
	var setConcat = true
	
	var operatFound = false
	var firstNum = 0
	var nextNum = 0
	var reset = false
	var emptyEquals = true
	
	@IBOutlet weak var calcField: UITextField!
	
	override func viewDidLoad() {
		super.viewDidLoad()
		calcField.text = String(0)
	}
	
	@IBAction func numbersInput(sender: UIButton) {
	
		if (reset == true) {
			nextValue = ""
			firstNumSet = false
			operate = "nothing"
			setConcat = true
			operatFound = false
			emptyEquals = true
			
			reset = false
		}
	
		previousValue = nextValue
		nextValue = sender.titleLabel!.text!
		
		if (setConcat == true)
		{
			nextValue = previousValue + nextValue
			calcField.text = nextValue
		}
		else
		{
			calcField.text = nextValue
		}
		
		setConcat = true
		emptyEquals = false
		firstNumSet = true

	}
	
	
	@IBAction func clear(sender: UIButton) {
		calcField.text = String(0)
		resultSoFar = 0
		
		nextValue = ""
		firstNumSet = false
		operate = "nothing"
		setConcat = true
		operatFound = false
		emptyEquals = true
	}
	
	@IBAction func equalSign(sender: AnyObject) {
		if (emptyEquals != true) {
			nextNum = nextValue.toInt()!
			resultSoFar = calculate (firstNum, nextNums: nextNum)
			calcField.text = String(resultSoFar)
			firstNum = resultSoFar
			
			reset = true
		}
	}
	
	@IBAction func add(sender: UIButton) {
		if (firstNumSet == false) {
			return
		}
		
		if (operatFound == false) {
			firstNum = nextValue.toInt()!
		} else {
			nextNum = nextValue.toInt()!
			resultSoFar = calculate (firstNum, nextNums: nextNum)
			calcField.text = String(resultSoFar)
			firstNum = resultSoFar
		}
		
		operate = "+"
		setConcat = false
		operatFound = true
	}
	
	
	@IBAction func multiply(sender: UIButton) {
		if (firstNumSet == false) {
			return
		}
		
		if (operatFound == false) {
			firstNum = nextValue.toInt()!
		} else {
			nextNum = nextValue.toInt()!
			resultSoFar = calculate (firstNum, nextNums: nextNum)
			calcField.text = String(resultSoFar)
			firstNum = resultSoFar
		}
		
		operate = "x"
		setConcat = false
		operatFound = true

	}
	
	@IBAction func subtract(sender: UIButton) {
		if (firstNumSet == false) {
			return
		}
		
		if (operatFound == false) {
			firstNum = nextValue.toInt()!
		} else {
			nextNum = nextValue.toInt()!
			resultSoFar = calculate (firstNum, nextNums: nextNum)
			calcField.text = String(resultSoFar)
			firstNum = resultSoFar
		}
		
		operate = "-"
		setConcat = false
		operatFound = true
	}
	
	
	@IBAction func divide(sender: UIButton) {
		if (firstNumSet == false) {
			return
		}
		
		if (operatFound == false) {
			firstNum = nextValue.toInt()!
		} else {
			nextNum = nextValue.toInt()!
			resultSoFar = calculate (firstNum, nextNums: nextNum)
			calcField.text = String(resultSoFar)
			firstNum = resultSoFar
		}
		
		operate = "/"
		setConcat = false
		operatFound = true

	}
	
	func calculate (prevNum: Int, nextNums: Int) -> Int {
		if (operate == "+") {
			resultSoFar = prevNum + nextNums
		} else if (operate == "-") {
			resultSoFar = prevNum - nextNums
		} else if (operate == "x") {
			resultSoFar = prevNum * nextNums
		} else if (operate == "/") {
			resultSoFar = prevNum / nextNums
		}
		return resultSoFar
	}
}