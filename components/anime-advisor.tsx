"use client"

import type React from "react"

import { useState, useEffect, useRef } from "react"
import { Bot, User, Menu, X, History, Clock, Trash2, AlertTriangle } from "lucide-react"
import { Button } from "@/components/ui/button"
import { ScrollArea } from "@/components/ui/scroll-area"
import { Textarea } from "@/components/ui/textarea"
// Import Badge component
import { Badge } from "@/components/ui/badge"

type Message = {
  role: "user" | "assistant"
  content: string
}

type SearchHistory = {
  id: string
  query: string
  timestamp: number
}

export default function AnimeAdvisor() {
  const [input, setInput] = useState("")
  const [messages, setMessages] = useState<Message[]>([
    {
      role: "assistant",
      content:
        "Hello! I'm your anime advisor. Tell me what genres or themes you enjoy, and I'll recommend some anime series for you!",
    },
  ])
  const [isLoading, setIsLoading] = useState(false)
  const [searchHistory, setSearchHistory] = useState<SearchHistory[]>([])
  const [sidebarOpen, setSidebarOpen] = useState(true)
  const [showDeleteConfirm, setShowDeleteConfirm] = useState(false)
  const chatAreaRef = useRef<HTMLDivElement>(null)

  // Load search history from localStorage on component mount
  useEffect(() => {
    const savedHistory = localStorage.getItem("animeSearchHistory")
    if (savedHistory) {
      setSearchHistory(JSON.parse(savedHistory))
    }
  }, [])

  // Save search history to localStorage whenever it changes
  useEffect(() => {
    localStorage.setItem("animeSearchHistory", JSON.stringify(searchHistory))
  }, [searchHistory])

  // Add click event listener to close sidebar when clicking outside
  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      if (chatAreaRef.current && chatAreaRef.current.contains(event.target as Node) && window.innerWidth < 768) {
        setSidebarOpen(false)
      }
    }

    document.addEventListener("mousedown", handleClickOutside)
    return () => {
      document.removeEventListener("mousedown", handleClickOutside)
    }
  }, [])

  // Add this function before the return statement
  const getRandomAnimeGenres = () => {
    const genres = [
      "Action",
      "Adventure",
      "Comedy",
      "Drama",
      "Fantasy",
      "Horror",
      "Mecha",
      "Music",
      "Mystery",
      "Romance",
      "Sci-Fi",
      "Slice of Life",
      "Sports",
      "Supernatural",
      "Thriller",
    ]

    // Shuffle and take first 5
    return [...genres].sort(() => 0.5 - Math.random()).slice(0, 5)
  }

  // Add this state
  const [popularGenres] = useState(getRandomAnimeGenres())

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()

    if (!input.trim()) return

    // Add user message to chat
    const userMessage: Message = { role: "user", content: input }
    setMessages((prev) => [...prev, userMessage])

    // Add to search history
    const newHistoryItem: SearchHistory = {
      id: Date.now().toString(),
      query: input,
      timestamp: Date.now(),
    }
    setSearchHistory((prev) => [newHistoryItem, ...prev])

    // Clear input and set loading state
    setInput("")
    setIsLoading(true)

    try {
      // Use our API route instead of calling Anthropic directly
      const response = await fetch("/api/chat", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          model: "claude-3-haiku-20240307",
          max_tokens: 1000,
          system: `You are an anime recommendation assistant named "Anime Series". 
          Your job is to recommend anime based on user preferences, genres, themes, or specific requests.
          Provide thoughtful recommendations with brief descriptions.
          If asked about non-anime topics, politely redirect the conversation to anime.
          Be friendly, knowledgeable, and enthusiastic about anime.`,
          messages: [{ role: "user", content: input }],
        }),
      })

      if (!response.ok) {
        const errorData = await response.json()
        throw new Error(`HTTP error! status: ${response.status}, details: ${JSON.stringify(errorData)}`)
      }

      const data = await response.json()
      console.log("API Response:", data)

      // Handle the Anthropic Messages API response format
      if (data && data.content && data.content.length > 0 && data.content[0].type === "text") {
        const assistantMessage: Message = {
          role: "assistant",
          content: data.content[0].text,
        }
        setMessages((prev) => [...prev, assistantMessage])
      } else {
        console.error("Unexpected response structure:", data)
        throw new Error("Unexpected response structure")
      }
    } catch (error) {
      console.error("Error details:", error)
      let errorMessage = "An error occurred while processing your request. "
      if (error instanceof Error) {
        errorMessage += `Details: ${error.message}`
      }
      setMessages((prev) => [
        ...prev,
        {
          role: "assistant",
          content: errorMessage,
        },
      ])
    } finally {
      setIsLoading(false)
    }
  }

  const loadHistoryItem = (query: string) => {
    setInput(query)
  }

  const formatDate = (timestamp: number) => {
    return new Date(timestamp).toLocaleString()
  }

  const handleSubmitQuery = async (query: string) => {
    // Set loading state
    setIsLoading(true)

    try {
      // Use our API route instead of calling Anthropic directly
      const response = await fetch("/api/chat", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          model: "claude-3-haiku-20240307",
          max_tokens: 1000,
          system: `You are an anime recommendation assistant named "Anime Series". 
        Your job is to recommend anime based on user preferences, genres, themes, or specific requests.
        Provide thoughtful recommendations with brief descriptions.
        If asked about non-anime topics, politely redirect the conversation to anime.
        Be friendly, knowledgeable, and enthusiastic about anime.`,
          messages: [{ role: "user", content: query }],
        }),
      })

      if (!response.ok) {
        const errorData = await response.json()
        throw new Error(`HTTP error! status: ${response.status}, details: ${JSON.stringify(errorData)}`)
      }

      const data = await response.json()
      console.log("API Response:", data)

      // Handle the Anthropic Messages API response format
      if (data && data.content && data.content.length > 0 && data.content[0].type === "text") {
        const assistantMessage: Message = {
          role: "assistant",
          content: data.content[0].text,
        }
        setMessages((prev) => [...prev, assistantMessage])
      } else {
        console.error("Unexpected response structure:", data)
        throw new Error("Unexpected response structure")
      }
    } catch (error) {
      console.error("Error details:", error)
      let errorMessage = "An error occurred while processing your request. "
      if (error instanceof Error) {
        errorMessage += `Details: ${error.message}`
      }
      setMessages((prev) => [
        ...prev,
        {
          role: "assistant",
          content: errorMessage,
        },
      ])
    } finally {
      setIsLoading(false)
    }
  }

  const deleteHistoryItem = (id: string, e: React.MouseEvent) => {
    e.stopPropagation() // Prevent triggering the parent button's onClick
    setSearchHistory((prev) => prev.filter((item) => item.id !== id))
  }

  const clearAllHistory = () => {
    setSearchHistory([])
    setShowDeleteConfirm(false)
  }

  return (
    <div className="flex h-screen w-full bg-background">
      {/* Mobile sidebar toggle */}
      <Button
        variant="ghost"
        size="icon"
        className="fixed top-4 left-4 z-50 md:hidden"
        onClick={() => setSidebarOpen(!sidebarOpen)}
      >
        {sidebarOpen ? <X className="h-5 w-5" /> : <Menu className="h-5 w-5" />}
      </Button>

      {/* Sidebar */}
      <div
        className={`
    fixed md:relative z-40 w-80 h-full bg-white border-r transition-all duration-300 ease-in-out
    ${sidebarOpen ? "left-0" : "-left-80"}
    md:left-0
  `}
      >
        <div className="flex flex-col h-full">
          {/* Logo section in the sidebar */}
          <div className="p-4 border-b bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
            <h1 className="text-xl font-bold flex items-center justify-end gap-2 text-white">
              <span className="font-bold tracking-tight">Anime Series</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                strokeWidth="2"
                strokeLinecap="round"
                strokeLinejoin="round"
                className="h-6 w-6"
              >
                <circle cx="12" cy="12" r="10" />
                <path d="M8 14s1.5 2 4 2 4-2 4-2" />
                <line x1="9" y1="9" x2="9.01" y2="9" />
                <line x1="15" y1="9" x2="15.01" y2="9" />
              </svg>
            </h1>
          </div>

          {/* Popular Genres in Sidebar */}
          <div className="p-4 border-b">
            <h2 className="text-sm font-medium mb-2">Popular Genres</h2>
            <div className="flex flex-wrap gap-1">
              {popularGenres.map((genre) => (
                <Badge
                  key={genre}
                  variant="secondary"
                  className="cursor-pointer hover:bg-primary hover:text-primary-foreground transition-colors mb-1"
                  onClick={() => {
                    const query = `Recommend me some good ${genre} anime`
                    setInput(query)

                    // Add user message to chat
                    const userMessage: Message = { role: "user", content: query }
                    setMessages((prev) => [...prev, userMessage])

                    // Add to search history
                    const newHistoryItem: SearchHistory = {
                      id: Date.now().toString(),
                      query: query,
                      timestamp: Date.now(),
                    }
                    setSearchHistory((prev) => [newHistoryItem, ...prev])

                    // Trigger search immediately
                    handleSubmitQuery(query)
                  }}
                >
                  {genre}
                </Badge>
              ))}
            </div>
          </div>

          {/* About section with search history */}
          <div className="p-4 border-b">
            <h2 className="text-sm font-medium mb-2">About</h2>
            <p className="text-xs text-muted-foreground mb-4">
              Anime Series is an AI-powered anime recommendation tool. Ask about any genre, theme, or specific
              preferences to get personalized anime suggestions.
            </p>
          </div>

          {/* Search History section */}
          <div className="p-4 flex-1 overflow-hidden">
            <div className="flex items-center justify-between mb-2">
              <h2 className="text-sm font-medium flex items-center gap-2">
                <History className="h-4 w-4" />
                Search History
              </h2>
              {searchHistory.length > 0 && (
                <button
                  className="p-1 hover:bg-red-100 rounded-full transition-colors"
                  onClick={() => setShowDeleteConfirm(true)}
                  aria-label="Clear all history"
                >
                  <Trash2 className="h-4 w-4 text-red-500" />
                </button>
              )}
            </div>

            {/* Delete confirmation dialog */}
            {showDeleteConfirm && (
              <div className="bg-red-50 border border-red-200 rounded-md p-3 mb-3">
                <div className="flex items-start gap-2">
                  <AlertTriangle className="h-5 w-5 text-red-500 shrink-0 mt-0.5" />
                  <div>
                    <h3 className="text-sm font-medium text-red-800">Delete all history?</h3>
                    <p className="text-xs text-red-700 mt-1">This action cannot be undone.</p>
                    <div className="flex gap-2 mt-2">
                      <Button variant="destructive" size="sm" onClick={clearAllHistory} className="h-8 px-3 py-1">
                        Delete
                      </Button>
                      <Button
                        variant="outline"
                        size="sm"
                        onClick={() => setShowDeleteConfirm(false)}
                        className="h-8 px-3 py-1"
                      >
                        Cancel
                      </Button>
                    </div>
                  </div>
                </div>
              </div>
            )}

            <ScrollArea className="h-[calc(100vh-350px)]">
              <div className="space-y-2">
                {searchHistory.length > 0 ? (
                  searchHistory.map((item) => (
                    <div key={item.id} className="relative history-item-container rounded-md hover:bg-accent">
                      <button
                        className="w-full text-left p-2 transition-colors flex items-start gap-2 pr-8"
                        onClick={() => {
                          // Set input
                          setInput(item.query)

                          // Add user message to chat
                          const userMessage: Message = { role: "user", content: item.query }
                          setMessages((prev) => [...prev, userMessage])

                          // Trigger search immediately
                          handleSubmitQuery(item.query)
                        }}
                      >
                        <Clock className="h-4 w-4 mt-0.5 text-muted-foreground shrink-0" />
                        <div className="overflow-hidden">
                          <div className="marquee-container">
                            <p
                              className={`text-sm font-medium whitespace-nowrap ${item.query.length > 20 ? "marquee-text" : ""}`}
                            >
                              {item.query}
                            </p>
                          </div>
                          <p className="text-xs text-muted-foreground">{formatDate(item.timestamp)}</p>
                        </div>
                      </button>
                      <button
                        className="delete-button absolute right-2 top-1/2 -translate-y-1/2 p-1 hover:bg-red-100 rounded-full"
                        onClick={(e) => deleteHistoryItem(item.id, e)}
                        aria-label="Delete history item"
                      >
                        <Trash2 className="h-4 w-4 text-red-500" />
                      </button>
                    </div>
                  ))
                ) : (
                  <p className="text-sm text-muted-foreground p-2">No search history yet</p>
                )}
              </div>
            </ScrollArea>
          </div>
        </div>
      </div>

      {/* Main chat area */}
      <div className="flex-1 flex flex-col h-full" ref={chatAreaRef}>
        {/* Chat header */}
        <header className="border-b p-4 bg-gradient-to-r from-indigo-500/10 to-purple-500/10">
          <div className="flex flex-col items-center gap-2 text-center">
            <h1 className="text-2xl font-bold">Anime Series</h1>
            <p className="text-sm text-muted-foreground">AI-powered tool to suggest anime based on your preferences</p>
          </div>
        </header>

        {/* Chat messages */}
        <ScrollArea className="flex-1 p-4">
          <div className="space-y-4 max-w-3xl mx-auto">
            {messages.map((message, index) => (
              <div key={index} className={`flex ${message.role === "assistant" ? "justify-start" : "justify-end"}`}>
                <div
                  className={`
                    flex items-start gap-3 max-w-[80%] rounded-lg p-3
                    ${message.role === "assistant" ? "bg-muted text-foreground" : "bg-primary text-primary-foreground"}
                  `}
                >
                  {message.role === "assistant" && <Bot className="h-5 w-5 mt-1 shrink-0" />}
                  <div className="whitespace-pre-wrap">{message.content}</div>
                  {message.role === "user" && <User className="h-5 w-5 mt-1 shrink-0" />}
                </div>
              </div>
            ))}
            {isLoading && (
              <div className="flex justify-start">
                <div className="bg-muted text-foreground rounded-lg p-3 flex items-center gap-2">
                  <Bot className="h-5 w-5" />
                  <div className="flex items-center gap-1">
                    <div
                      className="w-2 h-2 rounded-full bg-primary animate-bounce"
                      style={{ animationDelay: "0ms" }}
                    ></div>
                    <div
                      className="w-2 h-2 rounded-full bg-primary animate-bounce"
                      style={{ animationDelay: "150ms" }}
                    ></div>
                    <div
                      className="w-2 h-2 rounded-full bg-primary animate-bounce"
                      style={{ animationDelay: "300ms" }}
                    ></div>
                  </div>
                </div>
              </div>
            )}
          </div>
        </ScrollArea>

        {/* Input area */}
        <div className="border-t p-4">
          <form onSubmit={handleSubmit} className="max-w-3xl mx-auto flex gap-2">
            <Textarea
              value={input}
              onChange={(e) => setInput(e.target.value)}
              placeholder="Ask for anime recommendations..."
              className="resize-none min-h-[60px]"
              onKeyDown={(e) => {
                if (e.key === "Enter" && !e.shiftKey) {
                  e.preventDefault()
                  handleSubmit(e)
                }
              }}
            />
            <Button type="submit" disabled={isLoading || !input.trim()}>
              Send
            </Button>
          </form>
        </div>
      </div>
    </div>
  )
}

