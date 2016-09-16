SELECT * FROM Employees 
WHERE NOT EXISTS
(SELECT *
FROM Orders
WHERE Orders.EmployeeID=Employees.EmployeeID AND OrderDate >= DATEADD(mm, -3, GETDATE()) AND
ShipCountry='USA');