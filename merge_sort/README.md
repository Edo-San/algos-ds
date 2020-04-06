# Merge Sort
Merge Sort is a great Divide & Conquer algorithm.
It is used to solve typical sorting problems, such as sorting an unsorted array of integers.

There are different implementations of the Merge Sort algorithm. I'll focus on the `top-down` `recursive` implementation.

# Usecase & steps
```
Given an array of n integers, return an ordered array containing the same n integers.
```

- Split recursively the input array until the length of the array is 1
- Order the resulting pieces
- Merge the results together

The merge function would work as follow:
- `A` is the first ordered slice
- `B` is the second ordered slice
- `C` is the output array
- `i` and `j` are the counters used to keep track of traversing `A` and `B` respectively
- `k` is the counter used to loop over C desired length
- Loop over k 1 to the length of A+B
- `if A[i] < B[j] -> push A[i] to C[k], i++`
- `if A[i] > B[j] -> push B[j] to C[k], j++`

# Optimizations
- If we run out either of A or B, we can directly merge the elements contained in the other array
- We can handle input arrays of odd lengths
- We can handle input arrays that contain multiple occurrences of the same values (i.e. if A[i] === B[j] we can directly pluck both elements and move both counters at once)
