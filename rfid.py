import serial
import urllib2

ser = serial.Serial('/dev/tty.usbmodem1411', 9600)
while True:
	card = ser.readline()
	card = "".join([s for s in card.split() if s.isdigit()])
	print urllib2.urlopen("http://adroper.dev/test/" + card).read()