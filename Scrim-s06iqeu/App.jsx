import React from "react"

export default function App() {
    const [messages, setMessages] = React.useState(["a", "b"])
    /**
     * Challenge:
     * - If there are no unread messages, display "You're all caught up!"
     * - If there's exactly 1 unread message, it should read "You have 
     *   1 unread message" (singular)
     * - If there are > 1 unread messages, display "You have <n> unread
     *   messages" (plural)
     */
    const doesExist = () => {
        if(messages.length > 1){
            return <p>You have {messages.length} unread messages</p>
        }
        else if(messages.length == 1){
            return <>You have 1 unread message</>
        }
        else if(messages.length > 0){
            return <>You're all caught up!</>
        }

    }
    return (
        <div>
            <h1>{doesExist()}</h1>
        </div>
    )
}
